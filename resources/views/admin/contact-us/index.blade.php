<!-- resources/views/contact-us/index.blade.php -->

@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>Contact Us</h4>
                <ul class="list-group">
                    @foreach($contacts as $contact)
                        <a href="{{ route('contact-us.show', $contact->id) }}" class="list-group-item {{ $contact->read ? '' : 'list-group-item-info' }}">
                            {{ $contact->subject }}
                        </a>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8">
                @yield('contact-content')
            </div>
        </div>
    </div>
@endsection
