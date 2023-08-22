@extends('layouts.admin.app')

@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Akses </h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="{{route ('admin.akses.create')}}" class="btn btn-warning btn-sm">Add Data</a>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                            @include('components.alert')

                                <table  id= "myDataTable" class="table table-bordered rounded" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                           
                                            <th>Id Akses</th>
                                            <th>Jenis Akses</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach ($dtAkses as $item)
                                        <tr>
                                           
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->jenis_akses}}</td>
                                            <td> 
                                               <div class="row">

                                               <a href="{{route('tampilakses', $item->id)}}" class="btn btn-warning icon-circle"><i class="fas fa-fw fa-edit" style="color:white" ></i></a>                 
                                               <form method="POST" action="{{ route('deleteakses', $item->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm icon-circle" data-toggle="tooltip" title='Delete'><i class="fas fa-fw fa-trash" style="color:white" ></i></button>
                        </form>

                                                </div>
                                                </td>  
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
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