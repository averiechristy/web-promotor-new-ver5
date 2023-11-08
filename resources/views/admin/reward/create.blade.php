@extends('layouts.admin.app')

@section('content')
                <!-- Begin Page Content -->
             

                    <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                    Tambah Reward Baru
                                    </div>
                                    <div class="card-body">
                                       <form name="saveform" action="{{route('admin.reward.simpan')}}"  enctype="multipart/form-data" method="post"  onsubmit="return validateForm()">
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
                                                <label for="" class="form-label">Judul Reward</label>
                                                <input name ="judul_reward" type="text" style="border-color: #01004C;" id="" class="form-control {{ $errors->has('judul_reward') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-describedby="passwordHelpInline" value="{{old('judul_reward')}}"oninvalid="this.setCustomValidity('Judul reward tidak boleh kosong')" oninput="setCustomValidity('')">
                                                @if ($errors->has('judul_reward'))
                                                    <p class="text-danger">{{$errors->first('judul_reward')}}</p>
                                                @endif
                                            </div> 

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Poin Reward</label>
                                                <input name ="poin_reward" type="number" min="1" style="border-color: #01004C;" id="" class="form-control {{ $errors->has('poin_reward') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-describedby="passwordHelpInline" value="{{old('poin_reward')}}"oninvalid="this.setCustomValidity('Poin reward tidak boleh kosong atau 0')" oninput="setCustomValidity('')">
                                                @if ($errors->has('poin_reward'))
                                                    <p class="text-danger">{{$errors->first('poin_reward')}}</p>
                                                @endif
                                            </div>

                                           

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Deskripsi Reward</label>
                                                <textarea name="deskripsi_reward" type="text" class="form-control {{$errors->has('deskripsi_reward') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" oninvalid="this.setCustomValidity('Deskripsi produk tidak boleh kosong')" oninput="setCustomValidity('')">{{old('deskripsi_reward')}}</textarea>

                                                @if ($errors->has('deskripsi_reward'))
                                                    <p class="text-danger">{{$errors->first('deskripsi_reward')}}</p>
                                                @endif
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Kuota Pemenang</label>
                                                <input name ="kuota" type="number" min="1" style="border-color: #01004C;" id="" class="form-control {{ $errors->has('kuota') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-describedby="passwordHelpInline" value="{{old('kuota')}}"oninvalid="this.setCustomValidity('Poin reward tidak boleh kosong atau 0')" oninput="setCustomValidity('')">
                                                @if ($errors->has('kuota'))
                                                    <p class="text-danger">{{$errors->first('kuota')}}</p>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                  <label for="exampleFormControlFile1">Upload Gambar (PNG atau JPG, maksimum 5 MB):</label>
                                                  <input  name="gambar_reward" type="file"  class="form-control-file {{$errors->has('gambar_reward') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{old('gambar_reward')}}"  oninvalid="this.setCustomValidity('Gambar artikel tidak boleh kosong')" oninput="setCustomValidity('')"  accept=".png, .jpg, .jpeg" 
               title="Hanya file dengan ekstensi .png, .jpg, atau .jpeg yang diterima" 
               size="5000" onchange="previewImage(this)" accept="image/*">
               <img id="image-preview" src="#" alt="Preview" style="max-width: 100%; max-height: 200px; display: none;">

                                                  @if ($errors->has('gambar_reward'))
                                                    <p class="text-danger">{{$errors->first('gambar_reward')}}</p>
                                                @endif
                                                </div>
                                                
                                                <script>
                                                  function previewImage(input) {
    var preview = document.getElementById('image-preview');
    var file = input.files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }

        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
}

                                                </script>
                                            
                                            <div class="form-group mb-4">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', isset($reward) ? $reward->tanggal_mulai : '') }}" >
                        </div>

                        <div class="form-group mb-4">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', isset($reward) ? $reward->tanggal_selesai : '') }}">
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

    <script>
function validateForm() {
  let koderole = document.forms["saveform"]["role_id"].value;
  let judul_reward = document.forms["saveform"]["judul_reward"].value;
  let poin_reward = document.forms["saveform"]["poin_reward"].value;
  let deskripsi_reward = document.forms["saveform"]["deskripsi_reward"].value;
  let gambar_reward = document.forms["saveform"]["gambar_reward"].value;
  let tanggal_mulai = document.forms["saveform"]["tanggal_mulai"].value;
  let tanggal_selesai = document.forms["saveform"]["tanggal_selesai"].value;
  let kuota = document.forms["saveform"]["kuota"].value;


  if (koderole == "") {
    alert("Kode role tidak boleh kosong");
    return false;
  } else if (judul_reward == "") {
    alert("Judul reward tidak boleh kosong");
    return false;
  } else if (poin_reward == "") {
    alert("Poin reward tidak boleh kosong");
    return false;
  }else if (deskripsi_reward == "") {
    alert("Deskripsi reward tidak boleh kosong");
    return false;

  }else if (kuota == "") {
    alert("Kuota pemenang tidak boleh kosong");
    return false;
  }else if (gambar_reward == "") {
    alert("Gambar reward tidak boleh kosong");
    return false;
  } else if (tanggal_mulai == "") {
    alert("Tanggal mulai tidak boleh kosong");
    return false;
  } else if (tanggal_selesai == "") {
    alert("Tanggal selesai tidak boleh kosong");
    return false;
  } else {
    // Konversi nilai tanggal ke objek Date
    let startDate = new Date(tanggal_mulai);
    let endDate = new Date(tanggal_selesai);

    // Periksa apakah tanggal mulai lebih awal dari tanggal selesai
    if (startDate > endDate) {
      alert("Tanggal mulai tidak boleh lebih awal dari tanggal selesai");
      return false;
    }
  }
}
</script>





    <!-- End of Page Wrapper -->
    @endsection

