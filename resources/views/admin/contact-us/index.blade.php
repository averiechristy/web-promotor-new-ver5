@extends('layouts.admin.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h4 class="text-center mb-4">Contact Us</h4>
                @include('components.alert')
                <div class="row">
                    @foreach($contacts as $contact)
                        <div class="col-md-6">
                            <a href="{{ route('contact-us.show', $contact->id) }}">
                                <div class="card mb-3 {{ $contact->read ? 'bg-light text-black' : 'bg-white text-black' }}" data-id="{{ $contact->id }}">
                                    <div class="card-body">
                                        <h5 class="card-title">Subject : {{ $contact->subject }}</h5>
                                    </div>
                                    <div class="card-footer">
                                        <form action="{{ route('contact-us.delete', $contact->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm show_confirm3">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="col" id="contact-content">
                    @yield('contact-content')
                </div>
                <div class="pagination justify-content-center mt-3">
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
const cardBodies = document.querySelectorAll('.card-body');
let currentPage = 1; // Default to page 1

cardBodies.forEach((cardBody) => {
    cardBody.addEventListener('click', function() {
        // Dapatkan id kontak dari data-id pada card
        const contactId = cardBody.closest('.card').getAttribute('data-id');
        
        // Dapatkan status 'read' dari data-card
        const isRead = cardBody.closest('.card').classList.contains('bg-light');
        
        // Cek apakah pesan belum dibaca
        if (!isRead) {
            // Kirim permintaan AJAX untuk menandai pesan sebagai telah dibaca
            fetch(`{{ route('contact-us.mark-as-read', '') }}/${contactId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({}),
            })
            .then((response) => {
                if (response.ok) {
                    // Ubah warna card
                    cardBody.closest('.card').classList.remove('bg-white');
                    cardBody.closest('.card').classList.add('bg-light');
                    
                    // Kurangi jumlah pesan di sidebar Contact Us (misalnya dengan mengubah teks badge)
                    const contactCountBadge = document.getElementById('contact-count-badge');
                    const currentCount = parseInt(contactCountBadge.textContent);
                    contactCountBadge.textContent = currentCount - 1;
                    
                    // Setelah menandai pesan, perbarui konten pesan
                    updateContactContent(contactId);
                } else {
                    // Handle error jika diperlukan
                    console.error('Gagal menandai pesan sebagai telah dibaca.');
                }
            })
            .catch((error) => {
                console.error('Terjadi kesalahan:', error);
            });
        }
    });
});

// Fungsi ini digunakan untuk mengganti halaman dengan AJAX
function changePage(newPageNumber) {
    // Kirim permintaan AJAX untuk mengganti halaman dan perbarui konten
    fetch(`{{ route('admin.contact-us.index') }}?page=${newPageNumber}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
    })
    .then((response) => {
        if (response.ok) {
            return response.text();
        } else {
            // Handle error jika diperlukan
            console.error('Gagal mengganti halaman.');
            return null;
        }
    })
    .then((newContent) => {
        if (newContent !== null) {
            // Perbarui konten dengan konten baru dari halaman yang diambil dengan AJAX
            document.getElementById('contact-content').innerHTML = newContent;
            
            // Setelah berhasil mengganti halaman (misalnya dengan AJAX), perbarui currentPage
            currentPage = newPageNumber;
        }
    })
    .catch((error) => {
        console.error('Terjadi kesalahan:', error);
    });
}

// Fungsi ini digunakan untuk mengambil konten pesan dengan AJAX dan memperbarui elemen dengan ID "contact-content"
function updateContactContent(contactId) {
    // Kirim permintaan AJAX untuk mengambil konten pesan
    fetch(`{{ route('contact-us.show', '') }}/${contactId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
    })
    .then((response) => {
        if (response.ok) {
            return response.text();
        } else {
            // Handle error jika diperlukan
            console.error('Gagal mengambil konten pesan.');
            return null;
        }
    })
    .then((content) => {
        if (content !== null) {
            // Perbarui elemen dengan ID "contact-content" dengan konten pesan yang baru
            document.getElementById('contact-content').innerHTML = content;
        }
    })
    .catch((error) => {
        console.error('Terjadi kesalahan:', error);
    });
}

</script>
@endpush
