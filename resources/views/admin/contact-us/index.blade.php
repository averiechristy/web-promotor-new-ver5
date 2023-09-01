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
                            <div class="card mb-3 {{ $contact->read ? '' : 'bg-info text-white' }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $contact->subject }}</h5>
                                    <a href="{{ route('contact-us.show', $contact->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                                    <form method="POST" action="{{ route('contact-us.delete', $contact->id) }}" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin untuk menghapus pesan ini?')">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col">
                @yield('contact-content')
            </div>
                </div>      
                <div class="pagination justify-content-center mt-3">
                    {{ $contacts->links() }}
                </div>      
            </div>
        </div>
    </div>

    
@endsection



   

