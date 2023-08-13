@extends('layouts.admin.app')

@section('content')



                <!-- Begin Page Content -->
             

                <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Insert a new Artikel
                                    </div>
                                    <div class="card-body">
                                       <form action="#" method="post">
                                            <!-- @csrf -->

        

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Judul Artikel</label>
                                                <input name="code" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required />
                                                <!-- @if ($errors->has('code'))
                                                    <p class="text-danger">{{$errors->first('code')}}</p>
                                                @endif -->
                                            </div>
                                    
                                            <form>
                                                <div class="form-group">
                                                  <label for="exampleFormControlFile1">Upload Gambar Produk</label>
                                                  <input type="file" class="form-control-file" id="exampleFormControlFile1">
                                                </div>
                                              </form>
                                           
                                              <label>Isi Artikel</label>
                <div class="form-group">
                    <textarea id="editor"></textarea>
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
@endsection