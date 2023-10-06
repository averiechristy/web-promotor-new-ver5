@extends('layouts.admin.app')

@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Reward</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="{{route('admin.reward.create')}}" class="btn btn-warning btn-sm">Tambah Data</a>
                        </div>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                            @include('components.alert')

                                <table id= "myDataTable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="border-radius: 10px;">
                                    <thead>
                                        <tr>
                                          <th>Role</th>
                                          <th>Judul Reward</th>
                                          <th>Poin Reward</th>
                                          <th>Deskripsi Reward</th>
                                          <th>Gambar Reward</th>
                                          <th>Tanggal Mulai</th>
                                          <th>Tanggal Berakhir</th>
                                          <th>Status</th>
                                          <th>Created At</th>
                                          <th>Created By</th>
                                          <th>Updated At</th>
                                          <th>Updated By</th>      
                                           <th>Action</th>  

                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    @foreach ($reward as $item) 
                                   <tr>
<td> {{$item ->Role->jenis_role}} </td>
<td> {{$item->judul_reward}} </td>

<td>

<a href="#" data-toggle="modal" data-target="#gambarModal{{ $item->id }}">Lihat Gambar</a>


<!-- Kode lainnya -->

<!-- Modal untuk gambar artikel -->
<div class="modal fade" id="gambarModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel{{ $item->id }}" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="gambarModalLabel{{ $item->id }}">Gambar Reward</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<img src="{{ asset('img/'.$item->gambar_reward) }}" alt="Gambar Reward" class="img-fluid">
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>
<!-- {{ $item->gambar_produk}} -->
</td>
<td>   <a href="{{ route('detailreward', $item->id) }}"><button type="button" class="btn btn-link">
    Lihat Deskripsi Reward
</button></a>     </td>
<td>{{$item->poin_reward}} </td>
<td> {{$item->tanggal_mulai}}</td>
<td>  {{$item->tanggal_selesai}}</td>
<td>    @if ($item->status === 'Sedang berjalan')
                                            <span class="badge badge-success">Sedang Berjalan</span>
                                        @elseif($item->status === 'Akan datang')
                                            <span class="badge badge-warning">Akan Datang</span>
                                            @else 
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        @endif</td>
<td> {{$item->created_at}}</td>
<td> @if ($item->created_by)
                {{ $item->created_by }}
            @else
                User tidak terdeteksi
            @endif</td>
<td> {{$item->updated_at}} </td>
<td> @if ($item->updated_by)
                {{ $item->updated_by }}
            @else
               Belum ada pembaruan
            @endif</td>

                                           <td> 
                                           <div class="row">
                                           @if ($item->status === 'Tidak Aktif')
                                           <button class="btn" data-toggle="tooltip" title='Tidak dapat edit data yang sudah tidak aktif' disabled><i class="fas fa-fw fa-edit" style="color:gray"></i></button>            @else
                <a href="{{ route('tampilreward', $item->id) }}" class="btn" data-toggle="tooltip" title='Edit'><i class="fas fa-fw fa-edit" style="color:orange"></i></a>
            @endif
                                       <form method="POST" action="{{ route('deletereward', $item->id) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn show_confirm" data-toggle="tooltip" title='Hapus'><i class="fas fa-fw fa-trash" style="color:red" ></i></button>
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