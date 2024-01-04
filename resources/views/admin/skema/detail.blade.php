@extends('layouts.admin.app')
@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h4 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.skema.index') }}">Skema</a> / {{$data ->Produk ->nama_produk}} </h4>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        
                        <div class="card-body">
                            
                            <div class="table-responsive">
                           

                            <table id="myDataTable" class="table table-bordered" width="100%" cellspacing="0" style="border-radius: 10px;">
    <thead>
        <tr>
        <th>Insentif</th>
        <th>Minimal Quantity</th>
        <th>Maksimal Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($insentif as $item)
   <tr>
<td>{{$item -> insentif}}</td>
<td>{{$item -> min_qty}}</td>
<td>{{$item -> max_qty}}</td>
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