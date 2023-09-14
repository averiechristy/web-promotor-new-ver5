@extends('layouts.admin.app')

@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">User Role</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        
                        <div class="card-header py-3">
                            <a href="{{route ('admin.userrole.create')}}" class="btn btn-warning btn-sm">Tambah Data</a>
                            
                        </div>





                        <div class="card-body">

                        
                            
                            <div class="table-responsive">
                            @include('components.alert')
                                <table id= "myDataTable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                                    <thead>
                                        <tr>
                                           
                                            <th>Kode Role</th>
                                            <th>Jenis Role</th>
                                            <th>Akses</th>
                                            <th>Created At </th>
                                            <th>Created By </th>
                                            <th>Updated At </th>
                                            <th>Updated By</th>

                                           
                                            <th>Action</th>
                                          
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach ($dtUserRole as $item)
                                            
                                        
                                        <tr>
                                           
                                            <td>{{$item->kode_role}}</td>
                                            <td>{{$item->jenis_role}}</td>
                                            <td>{{ $item->Akses->jenis_akses }}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>   @if ($item->created_by)
                {{ $item->created_by }}
            @else
                User tidak terdeteksi
            @endif</td>
                                            <td>{{$item->updated_at}}</td>
<td>    @if ($item->updated_by)
                {{ $item->updated_by }}
            @else
                Belum ada pembaruan
            @endif</td>
                                            <td> 
                                            <div class="row">
                                                               <a href="{{route('tampildata', $item->id)}}"data-toggle="tooltip" class="btn" title='Edit'><i class="fas fa-fw fa-edit" style="color:orange" ></i></a>                 
                                                  
                                               
                                               <form method="POST" action="{{ route('delete', $item->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn show_confirm" data-toggle="tooltip" title='Hapus'><i class="fas fa-fw fa-trash" style="color:red"></i></button>
                        </form>             
                      </div>
                     </td>
                     </tr>
                     @endforeach
                     </tbody>
                      </table>
                      <nav aria-label="Page navigation example">
                    </nav>
                               

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