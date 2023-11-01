@extends('layouts.admin.app')

@section('content')

<div class="container">
    <h4 class="mb-4">History Reward</h4>
 
    <div class="row">
        @foreach ($rewards as $reward)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Tampilkan detail reward -->
                    <h5 class="card-title">{{ $reward->judul_reward }}</h5>

                    <hr>
                   
                  
                    <!-- Display the total number of users who reached 100% for this reward -->
                    <p class="card-text">
                        <strong>Total Pemenang</strong> {{ count($usersReached100Percent[$reward->id]) }}
                    </p>

                    <button data-toggle="modal" data-target="#detailModal{{ $reward->id }}" class="btn btn-primary btn-sm">Lihat detail pemenang</button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="detailModal{{ $reward->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">{{ $reward->judul_reward }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Tampilkan daftar nama pemenang di sini -->
                        @if (count($usersReached100Percent[$reward->id]) > 0)
                        <ol type="1">
                                @foreach ($usersReached100Percent[$reward->id] as $userId)
                                    @php
                                        $user = \App\Models\User::find($userId); // Ganti \App\User dengan model User Anda
                                    @endphp
                                    @if ($user)
                                        <li class="mt-2">{{ $user->nama }} ( {{$user->username}} )</li>
                                    @endif
                                @endforeach
</ol>
                        @else
                            <p>Tidak ada pemenang yang mencapai reward ini.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


<style>

    .card-title {

    font-weight: bold;
  white-space: nowrap;
  overflow: hidden;
  
  text-overflow: ellipsis;
  max-width: 100%; /* Atur lebar maksimum yang Anda inginkan */
  cursor: pointer;   
    }

    .card-title:hover {
        white-space: normal;
  max-width: none;
    }
</style>
@endsection
