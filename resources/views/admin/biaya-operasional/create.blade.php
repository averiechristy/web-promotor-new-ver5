@extends('layouts.admin.app')

@section('content')
                <!-- Begin Page Content -->
                    <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Tambahkan Biaya Operasional
                                    </div>
                                    <div class="card-body">
                                       <form name="saveform" action="{{route('admin.biayaoperasional.simpan')}}"  method="post" onsubmit="return validateForm()">
                                             @csrf @csrf
                                             <div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Role</label>
                                            <select  id="role" name="role_id" class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-label=".form-select-lg example"oninvalid="this.setCustomValidity('Pilih salah satu role')" oninput="setCustomValidity('')">
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
                                                <label for="" class="form-label">Biaya Operasional</label>
                                                <input name ="biaya_operasional" type="number" min="1" style="border-color: #01004C;" id="" class="form-control {{ $errors->has('biaya_operasional') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-describedby="passwordHelpInline" value="{{old('biaya_operasional')}}"oninvalid="this.setCustomValidity('Poin reward tidak boleh kosong atau 0')" oninput="setCustomValidity('')">
                                                @if ($errors->has('biaya_operasional'))
                                                    <p class="text-danger">{{$errors->first('biaya_operasional')}}</p>
                                                @endif
                                            </div>

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
  let akses = document.forms["saveform"]["akses_id"].value;
  let koderole = document.forms["saveform"]["kode_role"].value;
  let jenisrole = document.forms["saveform"]["jenis_role"].value;

  if (akses == "") {
    alert("Akses tidak boleh kosong");
    return false;
  } else   if (koderole == "") {
    alert("Kode role tidak boleh kosong");
    return false;
  } else   if (jenisrole == "") {
    alert("Jenis role tidak boleh kosong");
    return false;
  }
}
</script>
    <!-- End of Page Wrapper -->
    @endsection