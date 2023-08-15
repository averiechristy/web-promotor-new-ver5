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
                                       <form action="{{route('admin.product.simpan')}}" method="post">
                                            @csrf
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Role</label>

                                                <select class="form-control" aria-label=".form-select-lg example" style=" width: 50%;" required>
                                                                             <option selected>-- Pilih Kode Role--</option>
                                                    @foreach ($role as $item)
                                                    <option value="{{ $item->id }}">{{ $item->kode_role }} - {{$item->jenis_role}}</option>
                                                @endforeach
                                                  </select>
                                                <!-- @if ($errors->has('name'))
                                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                                @endif -->
                                            </div>
        

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Judul Paket</label>
                                                <input name="code" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required />
                                                <!-- @if ($errors->has('code'))
                                                    <p class="text-danger">{{$errors->first('code')}}</p>
                                                @endif -->
                                            </div>
                                    
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Deskripsi Paket</label>
                                                <textarea name="code" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required > </textarea>
                                                <!-- @if ($errors->has('code'))
                                                    <p class="text-danger">{{$errors->first('code')}}</p>
                                                @endif -->
                                            </div>
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
    <select class="form-control "  required>
                                                                             <option selected>-- Pilih Produk--</option>
                                                    @foreach ($produk as $item)
                                                    <option value="{{ $item->id }}">{{ $item->Role->jenis_role }}- {{$item->nama_produk}}</option>
                                                @endforeach
                                                  </select> 
    </div>
    <div class="col-md-4 mb-3">
      <!-- <label for="validationCustom02">Quantity</label> -->
      <input type="text" name="qty_produk" class="form-control" id="validationCustom02" placeholder="" value="" required>
     
    </div>

    <div class="col-md-3 mb-3">
      <!-- <label for="validationCustom05">Action</label> -->
      <button type="button" class="btn btn-danger icon-circle remove"><i class="fas fa-fw fa-trash" style="color:white"  data-toggle="modal" data-target="#deleteModal"></i></button>
      
    </div>
    </div>
            </div>
          </div>
  
          </form>
  

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


@endsection