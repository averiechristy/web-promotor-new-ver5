@extends('layouts.admin.app')
@section('content')
                <!-- Begin Page Content -->
                <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Tambahkan Produk Baru
                                    </div>
                                    <div class="card-body">
                                       <form action="{{route('admin.product.simpan')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                                <div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Role</label>
                                            <select name="role_id" class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-label=".form-select-lg example" required>
                                                <option disabled selected>-- Pilih Kode Role--</option>
                                                @foreach ($role as $item)
                                                    @if ($item->Akses->jenis_akses === 'User') <!-- Ubah kondisi ini -->
                                                    <option value="{{ $item->id }}"{{ old('role_id') == $item->id ? 'selected' : '' }}> {{ $item->kode_role }} - {{$item->jenis_role}}</option>
                                                    @endif
                                                @endforeach
                                            </select> 
                                            @if ($errors->has('role_id'))
                                                <p class="text-danger">{{ $errors->first('role_id') }}</p>
                                            @endif
                                            </div>
                               
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Nama Produk</label>
                                                <input name ="nama_produk" type="text" style="border-color: #01004C;" id="" class="form-control {{ $errors->has('nama_produk') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-describedby="passwordHelpInline" value="{{old('nama_produk')}}">
                                                @if ($errors->has('nama_produk'))
                                                    <p class="text-danger">{{$errors->first('nama_produk')}}</p>
                                                @endif
                                            </div> 

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Poin Produk</label>
                                                <input name="poin_produk" type="number" style="border-color: #01004C;"  id="" class="form-control {{ $errors->has('poin_produk') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-describedby="passwordHelpInline" value="{{old('poin_produk')}}" >
                                                    @if ($errors->has('poin_produk'))
                                                    <p class="text-danger">{{$errors->first('poin_produk')}}</p>
                                                @endif
                                            </div> 
                                            
                                            <div class="form-group">
    <label for="exampleFormControlFile1">Upload Gambar Produk</label>
    <input name="gambar_produk" type="file" class="form-control-file {{ $errors->has('gambar_produk') ? 'is-invalid' : '' }}" style="border-color: #01004C;" onchange="previewImage(this)" accept="image/*">
    
    <!-- Pratinjau gambar -->
    @if (old('gambar_produk') || session('gambar_produk_path'))
        @if (old('gambar_produk'))
            <img id="gambar-preview" src="{{ asset('storage/' . old('gambar_produk')) }}" alt="Pratinjau Gambar" style="max-width: 200px;">
        @else
            <img id="gambar-preview" src="{{ asset('storage/' . (session('gambar_produk_path') ?? '')) }}" alt="Pratinjau Gambar" style="max-width: 200px;">
        @endif
    @elseif (isset($product) && $product->gambar_produk)
        <img id="gambar-preview" src="{{ asset('storage/' . $product->gambar_produk) }}" alt="Pratinjau Gambar" style="max-width: 200px;">
    @else
        <img id="gambar-preview" src="#" alt="Pratinjau Gambar" style="max-width: 200px; display: none;">
    @endif
    
    @if ($errors->has('gambar_produk'))
        <p class="text-danger">{{ $errors->first('gambar_produk') }}</p>
    @endif
    </div>

    <script>
    window.onload = function() {
        var gambarPreview = document.getElementById('gambar-preview');
        var gambarInput = document.querySelector('input[name="gambar_produk"]');
        
        var sessionGambarPath = '{{ session('gambar_produk_path') }}';
        
        if (sessionGambarPath) {
            // Jika ada session gambar_produk_path, tampilkan pratinjau
            gambarPreview.src = '{{ asset('storage/') }}' + sessionGambarPath;
            gambarPreview.style.display = 'block';
        } else if (gambarInput.files && gambarInput.files[0]) {
            // Jika ada gambar yang dipilih, tampilkan pratinjau
            gambarPreview.src = URL.createObjectURL(gambarInput.files[0]);
            gambarPreview.style.display = 'block';
        }
    }

    function previewImage(input) {
        var preview = document.getElementById('gambar-preview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Tampilkan pratinjau
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none'; // Sembunyikan pratinjau jika tidak ada gambar yang dipilih
        }
    }
</script>


                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Deskripsi Product</label>
                                                <textarea name="deskripsi_produk" type="text" class="form-control {{$errors->has('deskripsi_produk') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{old('deskripsi_produk')}}" > {{old('deskripsi_produk')}} </textarea>
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
            </div>
        </div>
    </div>
@endsection