@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.product.index') }}">Deskripsi Produk</a> / {{$data -> nama_produk}}</h1>
{!! nl2br(e($data->deskripsi_produk)) !!}</div>

@endsection