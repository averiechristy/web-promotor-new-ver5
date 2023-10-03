@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.reward.index') }}">Deskripsi Reward</a> / {{$data -> judul_reward}}</h1>
{!! nl2br(e($data->deskripsi_reward)) !!}</div>

@endsection