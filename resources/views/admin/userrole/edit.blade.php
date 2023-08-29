@extends('layouts.admin.app')

@section('content')
                <!-- Begin Page Content -->
             

                    <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Edit Data User Role
                                    </div>
                                    <div class="card-body">
                                       <form action="/updatedata/{{$data->id}}" method="post">
                                             @csrf
                                             <div class="form-group mb-4">
    <label for="" class="form-label">Pilih Akses Role</label>

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

    @if($errors->has('akses_id'))
        <p class="text-danger">{{ $errors->first('akses_id') }}</p>
    @endif
</div>

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Role</label>
                                                <input name="kode_role" type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" style="border-color: #01004C;" value="{{ $data->kode_role }}" />
                                                @if($errors->has('kode_role'))
        <p class="text-danger">{{ $errors->first('kode_role') }}</p>
    @endif
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Jenis Role</label>
                                                <input name="jenis_role" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{ $data->jenis_role }}" />
                                                @if($errors->has('jenis_role'))
        <p class="text-danger">{{ $errors->first('jenis_role') }}</p>
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
    <!-- End of Page Wrapper -->
    @endsection