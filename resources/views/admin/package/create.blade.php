@extends('layouts.admin.app')

@section('content')
 

<div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Insert a new Package Income
                                    </div>
                                    <div class="card-body">
                                       <form action="{{route('admin.package.simpan')}}" method="post">
                                       @csrf
                                            <!-- 
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Role</label>

                                                <select id="role" name = "role_id" class="form-control role" aria-label=".form-select-lg example" style=" width: 50%;" required>
                                                                             <option selected></option>
                                                    @foreach ($produk as $item)
                                                    <option value="{{ $item->role_id }}">{{ $item->Role->kode_role }} - {{ $item->Role->jenis_role }} </option>
                                                @endforeach
                                                  </select>
                                                @if ($errors->has('name'))
                                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                                @endif
                                            </div>
         -->

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Judul Paket</label>
                                                <input name="judul_paket" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required />
                                               
                                            </div>
                                    
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Deskripsi Paket</label>
                                                <textarea name="deskripsi_paket" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required > </textarea>
                                                <!-- @if ($errors->has('code'))
                                                    <p class="text-danger">{{$errors->first('code')}}</p>
                                                @endif -->
                                            </div>

                                            <!-- <div class="control-group">
                                                <div class="form-row"> 
                                                    <div class="col-md-5 mb-3">
                                                    <label for="" class="form-label">Nama Produk</label>

                                                        <select name="data_produk[${counter}][nama_produk]" class="form-control produk" id="produk" required>
                                                         
                                                        </select>
                                                         </div>
                                                            <div class="col-md-4 mb-3">
                                                            <label for="" class="form-label">Quantity Produk</label>
                                                                <input type="text" name="data_produk[${counter}][qty_produk]" class="form-control" id="validationCustom02" placeholder="" value="" required>
                                                            </div>
                                                            
                                                            </div> -->
                                            <div class="form-group mb-4">
                                        <button class="btn btn-success addcustomer" type="button">
                                                <i class="glyphicon glyphicon-plus"></i> Add More Produk
                                                </button>                                        
                                                </div>
                                               

                                                <div class="customer"></div>

<!-- 
                                            <form action="#" method="POST">
                                            <div class="control-group after-add-more">
                                            <div class="form-row">
                                        <div class="col-md-5 mb-3">
                                        <label for="validationCustom01">Nama Produk</label>
                                        
                                        </div>
                                        <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Quantity</label>
                                        
                                        </div>
                                        
                                    
                                        </div>
                                        </div>
                                        
                                        <div class="form-group mb-4">
                                        <button class="btn btn-success add-more" type="button">
                                                <i class="glyphicon glyphicon-plus"></i> Add Produk
                                                </button>                                        
                                                </div>

                                                <div class="copy invisible">
                                                <div class="control-group">
                                                <div class="form-row">
                                        <div class="col-md-5 mb-3">
                                        <select name="produk_id" class="form-control "  required>
                                        <option selected>-- Pilih Produk--</option>
                                    @foreach ($produk as $item)
                                        <option value="{{ $item->id }}">{{ $item->Role->jenis_role }}- {{$item->nama_produk}}</option>
                                    @endforeach
                                    </select> 
                                        </div>
                                        <div class="col-md-4 mb-3">
                                        <input type="text" name="qty_produk" class="form-control" id="validationCustom02" placeholder="" value="" required>
                                        
                                        </div>

                                        <div class="col-md-3 mb-3">
                                        <button type="button" class="btn btn-danger icon-circle remove"><i class="fas fa-fw fa-trash" style="color:white"  data-toggle="modal" data-target="#deleteModal"></i></button>
                                        
                                        </div>
                                        </div>
                                                </div>
                                            </div>
                                    
                                            </form> -->
                                            <!-- <div class="form-group mb-4">
                                                <label for="" class="form-label"></label>
                                                <a href="#" class="addProduk btn btn-primary">Tambah Produk</a>
                                            </div> -->
<!--                                             
                                            <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">
                                                <div class="col-sm-10">
                                                    <a href="#" class="addCustomer btn btn-primary">tambah</a>
                                                </div>
                                            </label>

                                            </div>
                                            <div class='customer'></div>
                                             -->
                                          <!-- <div class="produk"></div> -->


                                            <div class="form-group mb-4">
                                                <button type="submit" class="btn " style="background-color: #01004C; color: white;">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
          
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script type="text/javascript">
 $(document).ready(function() {
        var counter = 0;

        $('.addcustomer').on('click', function() {
            var customer = `<div class="form-group mb-4">
            <label for="" class="form-label">Kode Role</label> <select id="role" name = "role_id" class="form-control role" aria-label=".form-select-lg example" style=" width: 50%;" required><option selected></option>@foreach ($produk as $item)<option value="{{ $item->role_id }}">{{ $item->Role->kode_role }} - {{ $item->Role->jenis_role }} </option>@endforeach</select><div class="control-group"><div class="form-row"> 
                
            <div class="col-md-5 mb-3">  
<label for="" class="form-label">Nama Produk</label>
<select name="data_produk[${counter}][nama_produk]" class="form-control produk" id="produk" required></select> </div>

<div class="col-md-4 mb-3">  <label for="" class="form-label">Quantity Produk</label><input type="number" name="data_produk[${counter}][qty_produk]" class="form-control" id="validationCustom02" placeholder="" value="" required></div>
<div class="col-md-3 mb-3"> 
 <label for="" class="form-label">Action</label>
<button type="button" class="btn btn-danger icon-circle remove">
<i class="fas fa-fw fa-trash" style="color:white"  data-toggle="modal" data-target="#deleteModal"></i>
</button></div>  </div>`;
            $('.customer').append(customer);
            counter++;
        });
    
    //  $(document).ready(function() {
    //     var counter = 0; // Counter untuk menambahkan customer
    // $('.addcustomer').on('click',function(){
    //     addcustomer();
    // });
    // function addcustomer(){
    //     var customer ='<div> <div class="form-group mb-4"><label for="" class="form-label">Kode Role</label> <select id="role" name = "role_id" class="form-control role" aria-label=".form-select-lg example" style=" width: 50%;" required><option selected></option>@foreach ($produk as $item)<option value="{{ $item->role_id }}">{{ $item->Role->kode_role }} - {{ $item->Role->jenis_role }} </option>@endforeach</select><div class="control-group"><div class="form-row"> <div class="col-md-5 mb-3">  <label for="" class="form-label">Nama Produk</label><select name="data_produk[${counter}][nama_produk]" class="form-control produk" id="produk" required></select> </div><div class="col-md-4 mb-3">  <label for="" class="form-label">Quantity Produk</label><input type="text" name="data_produk[${counter}][qty_produk]" class="form-control" id="validationCustom02" placeholder="" value="" required></div><div class="col-md-3 mb-3">  <label for="" class="form-label">Action</label><button type="button" class="btn btn-danger icon-circle remove"><i class="fas fa-fw fa-trash" style="color:white"  data-toggle="modal" data-target="#deleteModal"></i></button></div> </div></div></div>';
    //     $('.customer').append(customer);
    //     counter++;
    // };
    $(document).on('click', '.remove', function() {
        $(this).closest('.form-group').remove();
    });

    

    $(document).on('change', '.role', function(){
               var roleID = $(this).val();
               var produkSelect = $(this).closest('.form-group').find('.produk');
               if(roleID) {
                   $.ajax({
                       url: '/getProduct/'+roleID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            produkSelect.empty();
                            produkSelect.append('<option hidden>Choose produk</option>'); 
                            $.each(data, function(key, produk){
                                produkSelect.append('<option value="'+ produk.nama_produk +'">' + produk.kode_produk + " - " + produk.nama_produk+ '</option>');
                            });
                        }else{
                            produkSelect.empty();
                        }
                     }
                   });
               }else{
                 produkSelect.empty();
               }

               
            });
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
            $('#role').on('change', function() {
               var roleID = $(this).val();
               if(roleID) {
                   $.ajax({
                       url: '/getProduct/'+roleID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#produk').empty();
                            $('#produk').append('<option hidden>Choose produk</option>'); 
                            $.each(data, function(key, produk){
                                $('#produk').append('<option value="'+ produk.nama_produk +'">' + produk.kode_produk + " - " + produk.nama_produk+ '</option>');
                            });
                        }else{
                            $('#produk').empty();
                        }
                     }
                   });
               }else{
                 $('#produk').empty();
               }

               
            });

            
            });

            
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

@endsection