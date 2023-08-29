@extends('layouts.admin.app')

@section('content')



                <!-- Begin Page Content -->
             

                <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Insert a new Article
                                    </div>
                                    <div class="card-body">
                                       <form action="{{route('admin.artikel.simpan')}}" method="post"  enctype="multipart/form-data">
                                            @csrf

        

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Judul Artikel</label>
                                                <input name="judul_artikel" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" />
                                                @if ($errors->has('judul_artikel'))
                                                    <p class="text-danger">{{$errors->first('judul_artikel')}}</p>
                                                @endif
                                            </div>
                                    
                                            <div class="form-group">
                                                  <label for="exampleFormControlFile1">Upload Gambar Produk</label>
                                                  <input  name="gambar_artikel" type="file" class="form-control-file">
                                                  @if ($errors->has('gambar_artikel'))
                                                    <p class="text-danger">{{$errors->first('gambar_artikel')}}</p>
                                                @endif
                                                </div>
                                            
                                           
                                              <label>Isi Artikel</label>
                                              <div class="form-group">
                                              <textarea name="isi_artikel" class="my-editor form-control" id="my-editor" cols="30" rows="10"></textarea>                                             </div>
                                              @if ($errors->has('isi_artikel'))
                                                    <p class="text-danger">{{$errors->first('isi_artikel')}}</p>
                                                @endif
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