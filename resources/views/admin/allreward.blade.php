@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Reward</h2>
    <p><strong>Judul Reward:</strong> {{ $reward->judul_reward }}</p>

    <h6 class="mt-4">User yang Memenuhi Syarat:</h6>
    <ul class="list-group">
    @foreach($users as $user)
    <li class="list-group-item mt-3">
        <strong>{{ $user->nama }}</strong>

        <div class="progress mt-2">
            <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage[$user->id] }};" aria-valuenow="{{ $progressPercentage[$user->id] }}" aria-valuemin="0" aria-valuemax="100">
                <span class="progress-text">{{ $progressPercentage[$user->id] }}</span>
            </div>
        </div>
    </li>
@endforeach

</ul>
<style>
    .progress {
        height:20px;
        border-radius:50px;


    }
    .progress-bar {
        position: relative;
        background: linear-gradient(270deg, #1681FF 0%, rgba(22, 129, 255, 0.42) 100%);


       


        /* Menjadikan posisi relatif untuk progress bar */
    }

    .progress-text {
        position: absolute;
        top: 10px;
        right: 5px;
        font-weight : bold;
    }

    
</style>






    <div class="paginate mt-3">
    {{ $users->links() }}
</div>
</div>
@endsection
