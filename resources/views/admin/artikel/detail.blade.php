@extends('layouts.admin.app')

@section('content')

<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.artikel.index') }}">Berita</a> / Isi Berita</h1>
{!!$data->isi_artikel!!}
</div>

@endsection