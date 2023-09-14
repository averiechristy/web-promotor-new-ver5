@extends('layouts.admin.app')
@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Paket Pendapatan</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="{{route('admin.package.create')}}" class="btn btn-warning btn-sm">Tambah Data</a>
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
            <th>Created At </th>
            <th>Created By</th>

             <th>Updated At </th>
             <th>Updated By </th>

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
<td>{{ $item->created_at }}</td>
<td> @if ($item->created_by)
                {{ $item->created_by }}
            @else
                User tidak terdeteksi
            @endif</td>
<td>{{ $item->updated_at }}</td>
<td> @if ($item->updated_by)
                {{ $item->updated_by }}
            @else
                Belum ada pembaruan
            @endif</td>

                <td>
                    <div class="row">
                        <a href="{{ route('tampilpackage', $item->id) }}" class="btn" data-toggle="tooltip" title='Edit'><i class="fas fa-fw fa-edit" style="color:orange"></i></a>
                        <form method="POST" action="{{ route('deletepackage', $item->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn show_confirm" data-toggle="tooltip" title='Hapus'><i class="fas fa-fw fa-trash" style="color:red" ></i></button>
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