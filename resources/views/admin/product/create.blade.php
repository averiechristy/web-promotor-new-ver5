@extends('layouts.admin.app')

@section('content')

  
                <!-- Begin Page Content -->
             

                <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Insert a new product
                                    </div>
                                    <div class="card-body">
                                       <form action="#" method="post">
                                            <!-- @csrf -->
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Role</label>

                                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="border-color: #01004C; margin-left: 5px; width: 30%; border-radius: 5px;" required>
                                                    <option selected>Pilih Kode Role</option>
                                                    <option value="1">MS</option>
                                                    <option value="2">TM</option>
                                                    <option value="3">MR</option>
                                                  </select>
                                                <!-- @if ($errors->has('name'))
                                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                                @endif -->
                                            </div>
        

                                            <div class="row g-3 align-items-center " style="margin-bottom: 20px;">
                                                <div class="col-auto">
                                                  <label for="inputPassword6" class="col-form-label">Nama Produk</label>
                                                </div>
                                                <div class="col-auto">
                                                  <input type="text" style="border-color: #01004C;" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline" required>
                                                </div>
                                                <div class="col-auto">
                                                    <label for="inputPassword6" class="col-form-label">Poin</label>
                                                  </div>
                                                <div class="col-auto">
                                                    <input type="text" style="border-color: #01004C;"  id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline" required>

                                                </div>
                                              </div>
                                              <form>
                                                <div class="form-group">
                                                  <label for="exampleFormControlFile1">Upload Gambar Produk</label>
                                                  <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                                </div>
                                              </form>
                                    
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Deskripsi Product</label>
                                                <textarea name="code" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required > </textarea>
                                                <!-- @if ($errors->has('code'))
                                                    <p class="text-danger">{{$errors->first('code')}}</p>
                                                @endif -->
                                            </div>

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