@extends('layouts.admin.app')

@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">User Account</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="{{route('admin.useraccount.create')}}" class="btn btn-warning btn-sm">Add Data</a>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                            
                                <table id= "myDataTable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="border-radius: 10px;">
                                    <thead>
                                        <tr>
                                          
                                            <th>Id User</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Akses</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    @foreach ($dtUser as $item) 
                                        <tr>
                                           
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->password }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone_number }}</td>
                                            <td>{{ $item->Akses->jenis_akses }}</td>
                                            <td>{{ $item->Role->jenis_role }}</td>
                                            <td> 
                                               <div class="row">
                                               <a href="{{route('tampiluser', $item->id)}}" class="btn btn-warning icon-circle"><i class="fas fa-fw fa-edit" style="color:white" ></i></a>                 
                                               <form method="POST" action="{{ route('deleteuser', $item->id) }}">
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