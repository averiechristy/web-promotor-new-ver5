<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin - Exa</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
  
    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.10/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-oGqVXZhZl3uZI7zXxI0zkrDQywiU3Zb/6I5HJl4N/E5MOhwUsWJwJ90Gw97a2Q" crossorigin="anonymous">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="https://cdn.tiny.cloud/1/leb0njd3p3ivoira40rg4f6z9td385g0nvaokiax96r6t9um/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body id="page-top">

@include('components.admin.navbar') 
   
@yield('content')
@stack('scripts')

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
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


    <script src="https://cdn.datatables.net/1.11.10/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
   

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function(){
            $('#myDataTable').DataTable();
        });
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Apakah anda yakin untuk menghapus data ini?`,
              text: "Jika anda menghapus data ini, data ini akan hilang selamanya.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>

<script type="text/javascript">
 
     $('.show_confirm2').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Apakah anda yakin melakukan reset password?`,
              text: "Jika anda melakukan reset, maka password akan berubah menjadi default password.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>

<script type="text/javascript">
 
     $('.show_confirm3').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Apakah anda yakin ingin menghapus pesan?`,
              text: "Jika anda melakukan penghapusan, maka pesan akan hilang selamanya.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>

<!-- <script type="text/javascript">


    $(document).ready(function() {
      $(".add-more").click(function(){ 
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });
    });
    </script> -->





<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

    <script type="text/javascript">
    $(.addcustomer).on('click',function(){
    addcustomer();
    });

    function addcusotmer(){
        var cusotmer='<div><div class="form-group mb-4"><label for="" class="form-label">Judul Paket</label><input name="judul_paket" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required /></div></div>';
        $('.cusotmer').append(cusotmer);
    };

    $('.remove').live('click',function(){
    $(this).parent().parent().parent().remove();
    }) ;

    </script> -->



  <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('my-editor');
    </script>





</body>

</html>