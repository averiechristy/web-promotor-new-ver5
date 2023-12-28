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
                                       <form name="saveform" action="/updateproduct/{{$data->id}}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                                            @csrf
                                           
<div class="form-group mb-4">
    <label for="" class="form-label">Kode Role</label>
    <select name="role_id" class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" aria-label=".form-select-lg example"  oninvalid="this.setCustomValidity('Pilih salah satu role')" oninput="setCustomValidity('')">
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
                                                <input name ="nama_produk" type="text" style="border-color: #01004C;" id="" class="form-control {{ $errors->has('nama_produk') ? 'is-invalid' : '' }}"  aria-describedby="passwordHelpInline" value="{{ old('nama_produk', $data->nama_produk) }}"  oninvalid="this.setCustomValidity('Nama produk tidak boleh kosong')" oninput="setCustomValidity('')">
                                                  @if ($errors->has('nama_produk'))
                                                    <p class="text-danger">{{$errors->first('nama_produk')}}</p>
                                                @endif
                                            </div> 

                                            <div class="form-group mb-4">
    <div class="form-check form-switch">
        <input class="form-check-input switch"  name="flexSwitchCheckChecked" type="checkbox" role="switch" id="flexSwitchCheckChecked" onclick="toggleFormPoin()">
        <label class="form-check-label" for="flexSwitchCheckChecked">Konversi Poin</label>
    </div>
</div>

<div class="form-group mb-4 " id="formpoin" style="display: none;">
    <label for="" class="form-label">Poin Produk</label>
    <input
        name="poin_produk"
        value="{{ old('poin_produk', $data->poin_produk) }}" 
        type="number"
        style="border-color: #01004C;"
        id=""
        class="form-control {{ $errors->has('poin_produk') ? 'is-invalid' : '' }}"
        style="border-color: #01004C;"
        aria-describedby="passwordHelpInline"
        oninput="validatePoin(this)"
        step="any"
    >

  

    @if ($errors->has('poin_produk'))
        <p class="text-danger">{{$errors->first('poin_produk')}}</p>
    @endif
</div>


                                              <div class="form-group">
                                            <label for="file">Upload Gambar (PNG atau JPG, maksimum 5 MB):</label>
    <input id="gambar_produk_input" name="gambar_produk" type="file" class="form-control-file {{ $errors->has('gambar_produk') ? 'is-invalid' : '' }}" value="{{ old('data_gambar', $data->data_gambar) }}" accept=".png, .jpg, .jpeg" 
               title="Hanya file dengan ekstensi .png, .jpg, atau .jpeg yang diterima" 
               size="5000">
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
                                                <label for="" class="form-label">Deskripsi Produk</label>
                                                <textarea name="deskripsi_produk" type="text" class="form-control {{$errors->has('deskripsi_produk') ? 'is-invalid' : ''}}"  style="border-color: #01004C;"  oninvalid="this.setCustomValidity('Deskripsi produk tidak boleh kosong')" oninput="setCustomValidity('')"> {{ old('deskripsi_produk', $data->deskripsi_produk) }}</textarea>
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
    <script>
function validateForm() {
  let koderole = document.forms["saveform"]["role_id"].value;
  let nama = document.forms["saveform"]["nama_produk"].value;
  let deskripsi_produk = document.forms["saveform"]["deskripsi_produk"].value;


   if (koderole == "") {
    alert("Kode role tidak boleh kosong");
    return false;
  } else   if (nama == "") {
    alert("Nama produk tidak boleh kosong");
    return false;
  }else   if (deskripsi_produk == "") {
    alert("Deskripsi produk tidak boleh kosong");
    return false;
}
}

</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Periksa apakah ada nilai poin
        var poinValue = parseInt("{{ old('poin_produk', $data->poin_produk) }}");

        // Ambil elemen checkbox dan form poin
        var checkbox = document.getElementById('flexSwitchCheckChecked');
        var formpoin = document.getElementById('formpoin');

        // Jika ada nilai poin, aktifkan checkbox dan tampilkan form poin
        if (poinValue > 0) {
            checkbox.checked = true;
            formpoin.style.display = 'block';
        }
    });

    function toggleFormPoin() {
        var checkbox = document.getElementById('flexSwitchCheckChecked');
        var formpoin = document.getElementById('formpoin');

        if (checkbox.checked) {
            formpoin.style.display = 'block';
        } else {
            formpoin.style.display = 'none';
        }
    }
</script>



@endsection