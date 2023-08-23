@extends('layouts.admin.app')
@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Package Income</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="{{route('admin.package.create')}}" class="btn btn-warning btn-sm">Add Data</a>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                            @include('components.alert')

                            <table id="myDataTable" class="table table-bordered" width="100%" cellspacing="0" style="border-radius: 10px;">
    <thead>
        <tr>
            <th>Role</th>
            <th>Judul Paket</th>
            <th>Deskripsi Paket</th>
            <th>Produk</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dtPackage as $item)
            <tr>
                <td>{{ $item->Role->kode_role }}</td>
                <td>{{ $item->judul_paket }}</td>
                <td>{{ $item->deskripsi_paket }}</td>
                
                    
                    <td>    
                    <a href="{{ route('tampildetail', $item->id) }}"><button type="button" class="btn btn-link">
    Lihat Detail Produk
</button></a>

    
</td>
                <td>
                    <div class="row">
                        <a href="{{ route('tampilpackage', $item->id) }}" class="btn btn-warning icon-circle"><i class="fas fa-fw fa-edit" style="color:white"></i></a>
                        <form method="POST" action="{{ route('deletepackage', $item->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm icon-circle" data-toggle="tooltip" title='Delete'><i class="fas fa-fw fa-trash" style="color:white" ></i></button>
                        </form>                                               </div>
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
            <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer> -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

   


@endsection