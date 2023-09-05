@extends('layouts.user.app2')

@section('content2')

  <!-- ======= Edit Profil Section ======= -->
  <section id="edit-profil" class="edit-profil d-flex align-items-center">
        <div class="container">
  
          <div class="row justify-content-between">
            <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
               
                <img src="{{asset('img/editprofil.png')}}" class="img-fluid" alt="" >
                
            </div>

            
            <div class="col-lg-6 pt-5 pt-lg-0 form-edit">
          

   
            <form method="POST" action="{{ route('update-profile') }}" enctype="multipart/form-data">
        @csrf

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<div class="mb-3">
    <label for="name">Nama</label>
    <input id="nama" type="text" name="nama" value="{{ $user->nama }}" style="width: 80%;" class="form-control" oninput="removeExtraSpaces(this)">

<script>
function removeExtraSpaces(inputElement) {
    // Menghapus spasi berlebihan dengan menggunakan regex
    inputElement.value = inputElement.value.replace(/\s+/g, ' ');
}
</script>
    @if ($errors->has('nama'))
        <p class="text-danger">{{ $errors->first('nama') }}</p>
    @endif
</div>


          <div class="mb-3">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ $user->email }}"style="width: 80%;" class="form-control" >
            @if ($errors->has('email'))
                                                    <p class="text-danger">{{$errors->first('email')}}</p>
                                                @endif
        </div>

          <div class="mb-3">
            <label for="phone_number">Nomor Handphone</label>
            <input id="phone_number" type="number" name="phone_number" value="{{ $user->phone_number }}"style="width: 80%;" class="form-control">
            @if ($errors->has('phone_number'))
                                                    <p class="text-danger">{{$errors->first('phone_number')}}</p>
                                                @endif
          </div>

         

          <div class="mb-3">
            <button type="submit" class="btn-save me-md-2">Update Profile</button>
        </div>
    </form>
  
            
          </div>
  
        </div>
      </section><!-- End Edit Profil Section -->
  
      @endsection