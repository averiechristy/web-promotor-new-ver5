@extends('layouts.admin.app')

@section('content')



<div class="container">

@if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

                    <div class="row">
                       
                            <img src="{{asset('img/undraw_profile.svg')}}" style="height: 100px; width: 100px;">
                            <h3 style="margin-top: 34px; margin-left: 12px;">Admin</h3>
                            

                           
                       
                    </div>
                    <form method="POST" action="{{ route('change-password') }}">
        @csrf

        <div class="mb-3">
            <label for="current_password">Current Password</label>
            <input id="current_password" type="password" name="current_password" class="form-control" required>
            @error('current_password')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new_password">New Password</label>
            <input id="new_password" type="password" name="new_password" class="form-control" required>
            @error('new_password')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation">Confirm New Password</label>
            <input id="new_password_confirmation" type="password" name="new_password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Change Password</button>
        </div>
    </form>

@endsection