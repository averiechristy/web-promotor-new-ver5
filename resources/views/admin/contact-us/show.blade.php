<!-- resources/views/contact-us/show.blade.php -->

@extends('admin.contact-us.index')

@section('contact-content')
    <h4>Subject : {{ $kontak->subject }}</h4>
    <p>Nama : {{ $kontak->name }}</p>
    <p>Email : {{ $kontak->email }}</p>

    <p>Message : {{ $kontak->message }}</p>
    @if (!$kontak->read)
        <form action="{{ route('contact-us.mark-as-read', $kontak->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Mark as Read</button>
        </form>
    @endif
@endsection
