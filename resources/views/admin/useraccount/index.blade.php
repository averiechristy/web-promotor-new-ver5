@extends('layouts.admin.app')

@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">User Akun</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="{{route('admin.useraccount.create')}}" class="btn btn-warning btn-sm">Tambah Data</a>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                            @include('components.alert')

                                <table id= "myDataTable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="border-radius: 10px;">
                                    <thead>
                                        <tr>
                                          
                                            <th>Id User</th>
                                            <th>Nama</th>
                                            <th>Kode Sales (Username)</th>
                                            <!-- <th>Password</th> -->
                                            <th>Email</th>
                                            <th>No. Handhpone</th>
                                            <th>Akses</th>
                                            <th>Role</th>
                                            <th>Created At </th>
                                            <th>Created By </th>

                                            <th>Updated At </th>
                                            <th>Updated By </th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    @foreach ($dtUser as $item) 
                                        <tr>
                                           
                                            <td>{{ $item->kode_user}}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->username }}</td>
                                            <!-- <td>{{ $item->password }}</td> -->
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone_number }}</td>
                                            <td>{{ $item->Akses->jenis_akses }}</td>
                                            <td>{{ $item->Role->jenis_role }}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td> @if ($item->created_by)
                {{ $item->created_by }}
            @else
                User tidak terdeteksi
            @endif</td>

                                            <td>{{$item->updated_at}}</td>
                                            <td> @if ($item->updated_by)
                {{ $item->updated_by }}
            @else
                Belum ada pembaruan
            @endif</td>
                                           <td> 

                                              
                                               <form action="{{ route('admin.reset-password', ['user' => $item->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn show_confirm2" data-toggle="tooltip" title='Reset Password'><i class="fas fa-fw fa-redo"  style="color:#06234F" ></i></button>
            </form>
            
                                               <a href="{{route('tampiluser', $item->id)}}" data-toggle="tooltip" title='Edit' class="btn"><i class="fas fa-fw fa-edit"  style="color:orange;" ></i></a>                 
                                               <form method="POST" action="{{ route('deleteuser', $item->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn show_confirm" data-toggle="tooltip" title='Hapus'><i class="fas fa-fw fa-trash" style="color:red;" ></i></button>
                        </form>                                            
                                               
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