<!-- resources/views/contact-us/index.blade.php -->

@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>Contact Us</h4>
                <ul class="list-group">
                @include('components.alert')

                    @foreach($contacts as $contact)
                    <a href="{{ route('contact-us.show', $contact->id) }}" class="list-group-item {{ $contact->read ? '' : 'list-group-item-info' }}">
    {{ $contact->subject }}
</a>
<form method="POST" action="{{ route('contact-us.delete', $contact->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-xs btn-danger btn-sm btn-flat show_confirm " data-toggle="tooltip" title='Delete'>Delete</button>
                        </form>    
<!-- <div class="contact-actions" style="margin: top 10px; ">
    <a href="" class="btn btn-danger btn-sm">Delete</a>
</div> -->
<hr>

                    @endforeach
                </ul>

                <div class="pagination justify-content-center mt-3">
                    {{ $contacts->links() }}
                </div>

            </div>
            <div class="col-md-8">
                @yield('contact-content')
            </div>
        </div>
    </div>
@endsection
