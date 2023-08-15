@extends('layouts.admin.app')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Article</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="{{route('admin.artikel.create')}}" class="btn btn-warning btn-sm">Add Data</a>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                            
                                <table id= "myDataTable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="border-radius: 10px;">
                                    <thead>
                                        <tr>
                                           
                                            <th>Judul Artikel</th>
                                            <th>Gambar Artikel</th>
                                            <th>Isi Artikel</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    @foreach ($dtArtikel as $item) 
                                        <tr>
                                      
                                            <td>{{$item->judul_artikel}}</td>
                                            <td>
                                            <a href="{{asset('img/'.$item->gambar_artikel)}}" target="_black" rel="noopener noreferrer">Lihat Gambar</a>
                                            </td>
                                            <td>
                                            {!!$item->isi_artikel!!}
                                           
                                            <td> 
                                               <div class="row">
                                               <a href="{{route('tampilartikel', $item->id)}}" class="btn btn-warning icon-circle"><i class="fas fa-fw fa-edit" style="color:white" ></i></a>                 
                                                    <button type="button" class="btn btn-danger icon-circle"><i class="fas fa-fw fa-trash" style="color:white"  data-toggle="modal" data-target="#deleteModal"></i></button>
                                            
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
@endsection