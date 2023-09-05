@extends('layouts.admin.app')

@section('content')

  
                <!-- Begin Page Content -->
             

                <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                       Edit Produk
                                    </div>
                                    <div class="card-body">
                                       <form action="/updateproduct/{{$data->id}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                           
<div class="form-group mb-4">
    <label for="" class="form-label">Kode Role</label>
    <select name="role_id" class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" aria-label=".form-select-lg example" required>
        @foreach ($role as $item)
        @if ($item->Akses->jenis_akses === 'User')
            <option value="{{ $item->id }}"{{ old('role_id', $data->role_id) == $item->id ? 'selected' : '' }}>
                {{ $item->kode_role }} - {{ $item->jenis_role }}
            </option>
            @endif
        @endforeach
    </select>
    @if ($errors->has('role_id'))
        <p class="text-danger">{{ $errors->first('role_id') }}</p>
    @endif
</div>
<div class="form-group mb-4">
                                                <label for="" class="form-label">Nama Produk</label>
                                                <input name ="nama_produk" type="text" style="border-color: #01004C;" id="" class="form-control {{ $errors->has('nama_produk') ? 'is-invalid' : '' }}"  aria-describedby="passwordHelpInline" value="{{ old('nama_produk', $data->nama_produk) }}">
                                                  @if ($errors->has('nama_produk'))
                                                    <p class="text-danger">{{$errors->first('nama_produk')}}</p>
                                                @endif
                                            </div> 
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Poin Produk</label>
                                                <input name="poin_produk" type="number" style="border-color: #01004C;"  id="" class="form-control {{ $errors->has('poin_produk') ? 'is-invalid' : '' }}"  aria-describedby="passwordHelpInline" value="{{ old('poin_produk', $data->poin_produk) }}" >
                                                    @if ($errors->has('poin_produk'))
                                                    <p class="text-danger">{{$errors->first('poin_produk')}}</p>
                                                @endif
                                            </div> 


                                              <div class="form-group">
    <label for="exampleFormControlFile1">Upload Gambar Produk</label>
    <input id="gambar_produk_input" name="gambar_produk" type="file" class="form-control-file {{ $errors->has('gambar_produk') ? 'is-invalid' : '' }}" value="{{ old('data_gambar', $data->data_gambar) }}">
    @if ($errors->has('gambar_produk'))
        <p class="text-danger">{{$errors->first('gambar_produk')}}</p>
    @endif
</div>

<div class="form-group">
    <img id="gambar_produk_preview" src="{{ asset('img/'.$data->gambar_produk) }}" height="10%" width="50%" alt="" srcset="">
</div>

<script>
    // Fungsi untuk menampilkan gambar yang diunggah saat memilih file
    document.getElementById('gambar_produk_input').addEventListener('change', function (event) {
        const preview = document.getElementById('gambar_produk_preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
    });
</script>

                                    
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Deskripsi Product</label>
                                                <textarea name="deskripsi_produk" type="text" class="form-control {{$errors->has('deskripsi_produk') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" > {{ old('deskripsi_produk', $data->deskripsi_produk) }}</textarea>
                                                @if ($errors->has('deskripsi_produk'))
                                                    <p class="text-danger">{{$errors->first('deskripsi_produk')}}</p>
                                                @endif
                                            </div>

                                            <div class="form-group mb-4">
                                                <button type="submit" class="btn " style="background-color: #01004C; color: white;">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
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