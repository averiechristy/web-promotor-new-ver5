@extends('layouts.admin.app')
@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Package Income</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="add-package-income.html" class="btn btn-warning btn-sm">Add Data</a>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                            
                                <table id= "myDataTable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="border-radius: 10px;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Paket</th>
                                            <th>Deskripsi Paket</th>
                                            <th>Nama Produk</th>
                                            <th>QTY</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Penghasilan 3 juta</td>
                                            <td>Lorem ipsum dolor sit amet consectetur</td>
                                            <td>QRIS</td>
                                            <td>50</td>
                                            
                                           
                                            <td> 
                                               <div class="row">
                                                    <button type="button" class="btn btn-warning icon-circle" > <i class="fas fa-fw fa-edit" style="color:white"></i></button>
                                                    <button type="button" class="btn btn-danger icon-circle"><i class="fas fa-fw fa-trash" style="color:white"  data-toggle="modal" data-target="#deleteModal"></i></button>
                                            
                                                </div>
                                                </td>
                                            
                                        </tr>

                                        
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
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

@endsection