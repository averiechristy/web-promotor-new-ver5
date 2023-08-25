@extends('layouts.user.app')

@section('content')

    <!-- ======= Change Password Section ======= -->
    <section id="edit-profil" class="edit-profil">
        <div class="container">
  
          <div class="row justify-content-between">
            <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
              
               
                <img src="{{asset('img/password-edit.png')}}" class="img-fluid" alt="">   
            </div>

            
            <div class="col-lg-6 pt-5 pt-lg-0">
            @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('change-password') }}">
        @csrf
        <div class="button-income2">
        <div class="mb-3">
            <label for="current_password"class="form-label-nama" >Current Password</label>
            <input id="current_password" type="password" name="current_password"class="form-control" style="width: 50%;" required>
            @error('current_password')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="current_password"class="form-label-nama" >Current Password</label>
            <label for="new_password" >New Password</label>
            <input id="new_password" type="password" name="new_password" class="form-control" style="width: 50%;" required>
            @error('new_password')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label-nama" >Confirm New Password</label>
            <input id="new_password_confirmation" type="password" name="new_password_confirmation" class="form-control" style="width: 50%;" required>
        </div>

        <div class="mb-3">
            <button class="btn-save" type="submit">Save</button>
        </div>
    </form>
            </div>
          </div>
        </div>
      </section><!-- End change passwrod Section -->
@endsection