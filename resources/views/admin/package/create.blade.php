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
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Role</label>

                                                <select name = "role_id" class="form-control" aria-label=".form-select-lg example" style=" width: 50%;" required>
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
                                                <input name="judul_paket" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required />
                                                <!-- @if ($errors->has('code'))
                                                    <p class="text-danger">{{$errors->first('code')}}</p>
                                                @endif -->
                                            </div>
                                    
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Deskripsi Paket</label>
                                                <textarea name="deskripsi_paket" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required > </textarea>
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