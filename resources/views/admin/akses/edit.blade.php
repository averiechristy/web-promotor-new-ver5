@extends('layouts.admin.app')

@section('content')
                <!-- Begin Page Content -->
             

                    <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Edit Akses
                                    </div>
                                    <div class="card-body">
                                       <form action="/updateakses/{{$data->id}}" method="post">
                                             @csrf
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Jenis Akses</label>
                                                <input name="jenis_akses" type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" style="border-color: #01004C;" value="{{ $data->jenis_akses }}" required />
                                                <!-- @if ($errors->has('name'))
                                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                                @endif -->
                                            </div>
                                          
                                            
                                            <div class="form-group mb-4">
                                                <button type="submit" class="btn " style="background-color: #01004C; color: white;">Save</button>
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