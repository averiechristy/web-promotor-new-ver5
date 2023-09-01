@extends('layouts.admin.app')
@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h4 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.package.index') }}">Package Income</a> / {{$data->Role->kode_role}} - {{$data->judul_paket}}</h4>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        
                        <div class="card-body">
                            
                            <div class="table-responsive">
                           

                            <table id="myDataTable" class="table table-bordered" width="100%" cellspacing="0" style="border-radius: 10px;">
    <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Qty Produk</th>
            
        </tr>
    </thead>
    <tbody>
    @foreach ($produk as $detail)
            <tr>
              
                <td>{{ $detail->produk->nama_produk }}</td>
                <td>{{$detail->qty_produk}}</td>
                
                  
            
              
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