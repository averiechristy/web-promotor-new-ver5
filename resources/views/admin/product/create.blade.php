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
                                       <form name="saveform" action="{{route('admin.product.simpan')}}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                                            @csrf
                                                <div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Role</label>
                                            <select name="role_id" class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-label=".form-select-lg example"oninvalid="this.setCustomValidity('Pilih salah satu role')" oninput="setCustomValidity('')">
                                                <option value="" disabled selected>-- Pilih Kode Role--</option>
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
                                                <input name ="nama_produk" type="text" style="border-color: #01004C;" id="" class="form-control {{ $errors->has('nama_produk') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-describedby="passwordHelpInline" value="{{old('nama_produk')}}"oninvalid="this.setCustomValidity('Nama produk tidak boleh kosong')" oninput="setCustomValidity('')">
                                                @if ($errors->has('nama_produk'))
                                                    <p class="text-danger">{{$errors->first('nama_produk')}}</p>
                                                @endif
                                            </div> 

                                            <!-- <div class="form-group mb-4">
                                            <div class="form-check form-switch">
    <input class="form-check-input switch" type="checkbox" role="switch" id="flexSwitchCheckChecked" onclick="toggleFormPoin()">
    <label class="form-check-label" for="flexSwitchCheckChecked">Konversi Poin</label>
</div>
</div> -->
                                            
                                            <!-- <div id="formpoin" class="form-group mb-4" style="display: none;">
                                                <label for="" class="form-label">Poin Produk</label>
                                                <input
  name="poin_produk"
  type="number"
  style="border-color: #01004C;"
  id=""
  value="{{old('poin_produk')}}" 
  class="form-control {{ $errors->has('poin_produk') ? 'is-invalid' : '' }}"
  style="border-color: #01004C;"
  aria-describedby="passwordHelpInline"

  oninvalid="this.setCustomValidity('Poin produk harus lebih dari 0 ')"
  oninput="validatePoin(this)"
  min="1"
>

<script>
  function validatePoin(input) {
    if (input.value < 1) {
      input.setCustomValidity('Poin produk harus minimal 1');
    } else {
      input.setCustomValidity('');
    }
  }
</script>

                                                    @if ($errors->has('poin_produk'))
                                                    <p class="text-danger">{{$errors->first('poin_produk')}}</p>
                                                @endif
                                            </div>  -->

                                            <div class="form-group">
                                            <label for="file">Upload Gambar (PNG atau JPG, maksimum 5 MB):</label>
        <input type="file" name="gambar_produk" id="file"oninvalid="this.setCustomValidity('Gambar produk tidak boleh kosong')" oninput="setCustomValidity('')"  accept=".png, .jpg, .jpeg" 
               title="Hanya file dengan ekstensi .png, .jpg, atau .jpeg yang diterima" 
               size="5000" onchange="previewImage(this)" accept="image/*">  
               @if (session()->has('gambar_produk'))
    <img id="gambar-preview" src="{{ session('gambar_produk')->path() }}" alt="Preview Gambar Produk" style="max-width: 200px; max-height: 200px;">
    @else
    <img id="gambar-preview" src="{{ old('gambar_produk') }}" alt="Preview Gambar Produk" style="max-width: 200px; max-height: 200px; display: none;">
    @endif    
    @if ($errors->has('gambar_produk'))
    <p class="text-danger">{{$errors->first('gambar_produk')}}</p>
    @endif

</div>

<script>
function previewImage(input) {
    var preview = document.getElementById('gambar-preview');
    console.log(input.files); // Tampilkan input.files di konsol
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            console.log(e.target.result); // Tampilkan e.target.result di konsol
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}

</script>

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Deskripsi Produk</label>
                                                <textarea name="deskripsi_produk" type="text" class="form-control {{$errors->has('deskripsi_produk') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" oninvalid="this.setCustomValidity('Deskripsi produk tidak boleh kosong')" oninput="setCustomValidity('')">{{old('deskripsi_produk')}}</textarea>

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

    <script>
function validateForm() {
  let koderole = document.forms["saveform"]["role_id"].value;
  let nama = document.forms["saveform"]["nama_produk"].value;
  let gambar_produk = document.forms["saveform"]["gambar_produk"].value;
  let deskripsi_produk = document.forms["saveform"]["deskripsi_produk"].value;


   if (koderole == "") {
    alert("Kode role tidak boleh kosong");
    return false;
  } else   if (nama == "") {
    alert("Nama produk tidak boleh kosong");
    return false;
  }else   if (gambar_produk == "") {
    alert("Gambar produk tidak boleh kosong");
    return false;

}else   if (deskripsi_produk == "") {
    alert("Deskripsi produk tidak boleh kosong");
    return false;
}
}

</script>

<script>
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