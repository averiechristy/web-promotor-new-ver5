<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Exa Promoter</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logoexa.png" rel="icon">
  <link href="assets/img/logoexa.png" rel="">
  <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

  <!-- Vendor CSS Files -->
  <link href="{{asset('vendor2/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor2/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/lineicons.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    

  <!-- Template Main CSS File -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>

<body>

@include('components.user.header2') 
   
@yield('content2')


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{asset('vendor/aos/aos.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('vendor/php-email-form/validate.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Template Main JS File -->
<script src="{{asset('js/main.js')}}"></script>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk logout?</h5>
                   
                </div>
                <div class="modal-body">Pilih "logout" jika anda yakin untuk mengakhiri sesi anda.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const avatarInput = document.getElementById('avatar-input');
        const avatarPreview = document.getElementById('avatar-preview');
        const successMessage = document.getElementById('success-message');

        // Tampilkan gambar profil yang lama saat halaman dimuat
        const previousAvatarSrc = avatarPreview.getAttribute('src');
        avatarPreview.src = previousAvatarSrc;

        avatarInput.addEventListener('change', function() {
            const file = avatarInput.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            } else {
                // Kembalikan ke gambar profil yang lama jika tidak ada file yang dipilih
                avatarPreview.src = previousAvatarSrc;
            }
        });

        // Tampilkan pesan sukses setelah mengunggah
        const successNotification = "{{ session('success') }}";
        if (successNotification) {
            successMessage.classList.remove('d-none');
        }
    });
</script>



<script>
    @if($errors->has('avatar'))
        $(document).ready(function() {
            $('#changeProfilePhotoModal').modal('show');
        });
    @endif
</script>

</body>
</html>