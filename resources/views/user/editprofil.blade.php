@extends('layouts.user.app')

@section('content')

  <!-- ======= Edit Profil Section ======= -->
  <section id="edit-profil" class="edit-profil">
        <div class="container">
  
          <div class="row justify-content-between">
            <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
               
                <img src="{{asset('img/editprofil.png')}}" class="img-fluid" alt="" >
                
            </div>

            
            <div class="col-lg-6 pt-5 pt-lg-0">
            @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

            <div class="button-income">
            <form method="POST" action="{{ route('update-profile') }}" enctype="multipart/form-data">
        @csrf

          <div class="mb-3">
            <label for="name">Name</label>
            <input id="nama" type="text" name="nama" value="{{ $user->nama }}"style="width: 80%;" class="form-control" required>
        </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ $user->email }}"style="width: 80%;" class="form-control" required>
        </div>

          <div class="mb-3">
            <label for="phone_number">Phone Number</label>
            <input id="phone_number" type="tel" name="phone_number" value="{{ $user->phone_number }}"style="width: 80%;" class="form-control">
        </div>

         

          <div class="mb-3">
            <button type="submit" class="btn-save me-md-2">Update Profile</button>
        </div>
    </form>
            </div>
  
            
          </div>
  
        </div>
      </section><!-- End Edit Profil Section -->
  

@endsection