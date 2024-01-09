@extends('layouts.admin.app')

@section('content')
                <!-- Begin Page Content -->
                    <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Edit Biaya Operasional
                                    </div>
                                    <div class="card-body">
                                       <form name="saveform" action="/updatebiayaoperasional/{{$data->id}}"  method="post" onsubmit="return validateForm()">
                                             @csrf @csrf
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
                                                <label for="" class="form-label">Biaya Operasional</label>
                                                <input name ="biaya_operasional" type="number" min="1" style="border-color: #01004C;" id="" class="form-control {{ $errors->has('biaya_operasional') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-describedby="passwordHelpInline" value="{{old('biaya_operasional', $data -> biaya_operasional)}}"oninvalid="this.setCustomValidity('Poin reward tidak boleh kosong atau 0')" oninput="validasiNumber(this)">
                                                @if ($errors->has('biaya_operasional'))
                                                    <p class="text-danger">{{$errors->first('biaya_operasional')}}</p>
                                                @endif
                                            </div>

                                            <script>
function validasiNumber(input) {
    // Hapus karakter titik (.) dari nilai input
    input.value = input.value.replace(/\./g, '');

    // Pastikan hanya karakter angka yang diterima
    input.value = input.value.replace(/\D/g, '');
}
</script>

                                            <div class="form-group mb-4">
    <label for="tanggal_mulai">Tanggal Mulai</label>
    @php
        $sekarang = now()->format('Y-m-d');
    @endphp

    @if ($sekarang >= $data->tanggal_mulai && $sekarang <= $data->tanggal_selesai)
        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $data->tanggal_mulai) }}" readonly>
        <small class="text-muted">Tanggal Mulai tidak dapat diubah karena status sedang berjalan.</small>
    @else
        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $data->tanggal_mulai) }}" required>
    @endif
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
let biayaoperasional = document.forms["saveform"]["biaya_operasional"].value;
let tanggalmulai = document.forms["saveform"]["tanggal_mulai"].value;
let tanggalselesai = document.forms["saveform"]["tanggal_selesai"].value;

    if (koderole == "") {
    alert("Kode role tidak boleh kosong");
    return false;
  } else   if (biayaoperasional == "") {
    alert("Biaya Operasional tidak boleh kosong");
    return false;
  } else   if (tanggalmulai == "") {
    alert("Tanggal Mulai tidak boleh kosong");
    return false;
  }
    else   if (tanggalselesai == "") {
    alert("Tanggal Selesai tidak boleh kosong");
    return false;
    }
    else {
    // Konversi nilai tanggal ke objek Date
    let startDate = new Date(tanggalmulai);
    let endDate = new Date(tanggalselesai);

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