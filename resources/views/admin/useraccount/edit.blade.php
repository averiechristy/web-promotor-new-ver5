@extends('layouts.admin.app')

@section('content')



<div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Edit User Account
                                    </div>
                                    <div class="card-body">
                                       <form action="/updateuser/{{$data->id}}" method="post">
                                            @csrf

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">User Akses</label>
                                                <select name="akses_id" class="form-control" aria-label=".form-select-lg example" required>
    <option value="{{ $data->Akses->id }}">{{ $data->Akses->jenis_akses }}</option>
    @foreach ($akses as $item)
        @if ($data->akses_id != $item->id)
            <option value="{{ $item->id }}">{{ $item->jenis_akses }}</option>
        @endif
    @endforeach
</select>
@if($errors->has('akses_id'))
    <p class="text-danger">{{ $errors->first('akses_id') }}</p>
@endif

                                                @if ($errors->has('akses_id'))
                                                    <p class="text-danger">{{$errors->first('akses_id')}}</p>
                                                @endif
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Role</label>

                                                <select name="role_id" class="form-control" aria-label=".form-select-lg example" required>
                                                <option value="{{ $data->Role->id }}">{{ $data->Role->kode_role}} - {{ $data->Role->jenis_role}}</option>
        @foreach ($role as $item)
            @if ($data->role_id != $item->id)
                <option value="{{ $item->id }}">{{ $item->kode_role}} - {{ $item->jenis_role}}</option>
            @endif
        @endforeach
    </select>
                                                @if ($errors->has('role_id'))
                                                    <p class="text-danger">{{$errors->first('role_id')}}</p>
                                                @endif
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Nama</label>
                                                <input name="nama" type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" style="border-color: #01004C;" value="{{ $data->nama }}"  />
                                                @if ($errors->has('nama'))
                                                    <p class="text-danger">{{$errors->first('nama')}}</p>
                                                @endif
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Sales</label>
                                                <input name="username" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{ $data->username }}"  />
                                                @if ($errors->has('username'))
                                                    <p class="text-danger">{{$errors->first('username')}}</p>
                                                @endif
                                            </div>

                                           

                                              <div class="form-group mb-4">
                                                <label for="" class="form-label">Email</label>
                                                <input name="email" type="email" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{ $data->email }}" />
                                                @if ($errors->has('email'))
                                                    <p class="text-danger">{{$errors->first('email')}}</p>
                                                @endif
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">No Handphone</label>
                                                <input name="phone_number" type="number" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{ $data->phone_number }}" />
                                                @if ($errors->has('phone_number'))
                                                    <p class="text-danger">{{$errors->first('phone_number')}}</p>
                                                @endif
                                            </div>

                                            <div class="form-group mb-4">
                                                <button type="submit" class="btn " style="background-color: #01004C; color: white;">Simpan</button>
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