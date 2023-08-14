@extends('layouts.admin.app')

@section('content')



<div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Insert a new user account
                                    </div>
                                    <div class="card-body">
                                       <form action="{{route('admin.product.simpan')}}" method="post">
                                            @csrf

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">User Akses</label>

                                                <select name = "akses_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="border-color: #01004C; margin-left: 5px; width: 30%; border-radius: 5px;" required>
                                                    <option selected>-- Pilih Akses --</option>
                                                   @foreach ($akses as $item)
                                                    <option value="{{ $item->id }}">{{ $item->jenis_akses }}</option>
                                                @endforeach
                                                  
                                                  </select>
                                                <!-- @if ($errors->has('name'))
                                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                                @endif -->
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Role</label>

                                                <select name = "role_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="border-color: #01004C; margin-left: 5px; width: 30%; border-radius: 5px;" required>
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
                                                <label for="" class="form-label">Nama</label>
                                                <input name="nama" type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" style="border-color: #01004C;" value="" required />
                                                <!-- @if ($errors->has('name'))
                                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                                @endif -->
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Username</label>
                                                <input name="username" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required />
                                                <!-- @if ($errors->has('code'))
                                                    <p class="text-danger">{{$errors->first('code')}}</p>
                                                @endif -->
                                            </div>

                                            <div class="row g-3 align-items-center " style="margin-bottom: 20px;">
                                                <div class="col-auto">
                                                  <label for="inputPassword6" class="col-form-label">Password</label>
                                                </div>
                                                <div class="col-auto">
                                                  <input name= "password" type="text" style="border-color: #01004C;" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline" required>
                                                </div>

                                                <div class="col-auto">
                                                    <input type="text" style="border-color: #01004C;"  id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline" placeholder="Re-type Password" required>

                                                </div>
                                              </div>

                                              <div class="form-group mb-4">
                                                <label for="" class="form-label">Email</label>
                                                <input name="email" type="email" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required />
                                                <!-- @if ($errors->has('code'))
                                                    <p class="text-danger">{{$errors->first('code')}}</p>
                                                @endif -->
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">No Handphone</label>
                                                <input name="phone_number" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required />
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


@endsection