@extends('layouts.admin.app')

@section('content')
                <!-- Begin Page Content -->
             

                    <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                    Edit Reward
                                    </div>
                                    <div class="card-body">
                                       <form name="saveform" action="/updatereward/{{$data->id}}" method="post" onsubmit="return validateForm()">
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
                                                <label for="" class="form-label">Judul Reward</label>
                                                <input name ="judul_reward" type="text" style="border-color: #01004C;" id="" class="form-control {{ $errors->has('judul_reward') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-describedby="passwordHelpInline" value="{{old('judul_reward', $data->judul_reward)}}" oninvalid="this.setCustomValidity('Judul reward tidak boleh kosong')" oninput="setCustomValidity('')">
                                                @if ($errors->has('judul_reward'))
                                                    <p class="text-danger">{{$errors->first('judul_reward')}}</p>
                                                @endif
                                            </div> 

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Poin Reward</label>
                                                <input name ="poin_reward" type="number" style="border-color: #01004C;" id="" class="form-control {{ $errors->has('poin_reward') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-describedby="passwordHelpInline" value="{{old('poin_reward', $data->poin_reward)}}"oninvalid="this.setCustomValidity('Poin reward tidak boleh kosong')" oninput="setCustomValidity('')">
                                                @if ($errors->has('poin_reward'))
                                                    <p class="text-danger">{{$errors->first('poin_reward')}}</p>
                                                @endif
                                            </div>
                                            
                                            <div class="form-group mb-4">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', isset($data) ? $data->tanggal_mulai : '') }}" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', isset($data) ? $data->tanggal_selesai : '') }}" required>
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
  let tanggal_mulai = document.forms["saveform"]["tanggal_mulai"].value;
  let tanggal_selesai = document.forms["saveform"]["tanggal_selesai"].value;

  if (koderole == "") {
    alert("Kode role tidak boleh kosong");
    return false;
  } else if (judul_reward == "") {
    alert("Judul reward tidak boleh kosong");
    return false;
  } else if (poin_reward == "") {
    alert("Poin reward tidak boleh kosong");
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

