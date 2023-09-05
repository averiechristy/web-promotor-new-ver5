@extends('layouts.user.app2')

@section('content2')

    <!-- ======= Change Password Section ======= -->
    <section id="edit-profil" class="edit-profil align-items-center">
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
        <div class="form-group mb-4">
    <div class="password-container position-relative">
        <input id="current_password" type="password" name="current_password" style="width:50%;" class="form-control" placeholder="Current Password">
       
        <i class="toggle-password fas fa-eye eye-toggle"></i>
    </div>
    @if($errors->has('current_password'))
        <p class="text-danger">{{ $errors->first('current_password') }}</p>
    @endif
</div>
<div class="form-group mb-4">
    <div class="password-container position-relative">
        <input id="new_password" type="password" name="new_password"  style="width:50%;" class="form-control" placeholder="New Password">
      
        <i class="toggle-password1 fas fa-eye eye-toggle"></i>
        
    </div>
    @if($errors->has('new_password'))
        <p class="text-danger">{{ $errors->first('new_password') }}</p>
    @endif
</div>

<div class="form-group mb-4">
    <div class="password-container position-relative">
        <input id="new_password_confirmation" type="password" name="new_password_confirmation"   style="width:50%;"class="form-control" placeholder="Confirm New Password">
        <i class="toggle-password2 fas fa-eye eye-toggle"></i>
    </div>
    @if($errors->has('new_password_confirmation'))
        <p class="text-danger">{{ $errors->first('new_password_confirmation') }}</p>
    @elseif($errors->has('new_password'))
        <p class="text-danger">{{ $errors->first('new_password') }}</p>
    @endif
</div>

       

        <div class="mb-3">
            <button class="btn-save" type="submit">Simpan</button>
        </div>
    </form>
            </div>
          </div>
        </div>
      </section><!-- End change passwrod Section -->


      

      <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('current_password');
    const togglePasswordIcon = document.querySelector('.toggle-password');

    togglePasswordIcon.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePasswordIcon.classList.remove('fa-eye');
            togglePasswordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            togglePasswordIcon.classList.remove('fa-eye-slash');
            togglePasswordIcon.classList.add('fa-eye');
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('new_password');
    const togglePasswordIcon = document.querySelector('.toggle-password1');

    togglePasswordIcon.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePasswordIcon.classList.remove('fa-eye');
            togglePasswordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            togglePasswordIcon.classList.remove('fa-eye-slash');
            togglePasswordIcon.classList.add('fa-eye');
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('new_password_confirmation');
    const togglePasswordIcon = document.querySelector('.toggle-password2');

    togglePasswordIcon.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePasswordIcon.classList.remove('fa-eye');
            togglePasswordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            togglePasswordIcon.classList.remove('fa-eye-slash');
            togglePasswordIcon.classList.add('fa-eye');
        }
    });
});
</script>
      @endsection