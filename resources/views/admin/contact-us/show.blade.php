<!-- resources/views/contact-us/show.blade.php -->
@extends('admin.contact-us.index')
@section('contact-content')
    <div class="card card-detail">
        <div class="card-header">
            Detail Kontak
            <button type="button" class="close" aria-label="Close" onclick="closeContactContent()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="card-body">
        @if ($kontak)
                    <h5 class="card-title">{{ $kontak->subject }}</h5>
                    <p class="card-text">Nama : {{ $kontak->name }}</p>
                    <p class="card-text">Email : {{ $kontak->email }}</p>
                    <p class="card-text">Message: {!! nl2br(e($kontak->message)) !!}</p>
                    
                   
                @endif      
     </div>
    </div>
@endsection

@push('scripts')
    <script>
        function closeContactContent() {
            // Hapus konten dari elemen dengan class "card" pada saat menutup
            document.querySelector('.card-detail').style.display = 'none';
        }
    </script>
@endpush


