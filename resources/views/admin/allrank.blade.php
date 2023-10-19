


@extends('layouts.admin.app')

@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Peringkat Leaderboard</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        
                     





                        <div class="card-body">

                        
                            
                            <div class="table-responsive">
                            @include('components.alert')
                                <table id= "myDataTable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                                    <thead>
                                        <tr>
                                           
                                        <tr>
        <th>Peringkat</th>
        <th>Nama</th>
        <th>Kode Sales</th>
        <th>Total</th>
    </tr>
                                          
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    @foreach ($rankings as $index => $ranking)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $ranking->nama }}</td>
        <td>{{ $ranking->kode_sales }}</td>
        <td>{{ $ranking->total }}</td>
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