@extends('layouts.admin.app')

@section('content')
                <!-- Begin Page Content -->
             

                    <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Tambahkan User Role Baru
                                    </div>
                                    <div class="card-body">
                                       <form name="saveform" action="{{route('admin.userrole.simpan')}}" method="post" onsubmit="return validateForm()">
                                             @csrf
                                             <div class="form-group mb-4">
                                                <label for="" class="form-label">Pilih Akses Role</label>

<select name="akses_id" class="form-control " style="border-color: #01004C;" aria-label=".form-select-lg example"  oninvalid="this.setCustomValidity('Pilih salah satu akses')" oninput="setCustomValidity('')" >
  

<option value="" selected disabled>-- Pilih Akses --</option>
    @foreach ($akses as $item)
        <option value="{{ $item->id }}"{{ old('akses_id') == $item->id ? 'selected' : '' }}> {{ $item->jenis_akses }}</option>
    @endforeach
</select>

                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Role</label>
                                                <input name="kode_role" type="text" class="form-control {{$errors->has('kode_role') ? 'is-invalid' : ''}}" style="border-color: #01004C;" value="{{old('kode_role')}}"  oninvalid="this.setCustomValidity('Kode role tidak boleh kosong')" oninput="setCustomValidity('')"/>
                                                <div id="validation-message"></div>
                                                @if($errors->has('kode_role'))
        <p class="text-danger">{{ $errors->first('kode_role') }}</p>
    @endif
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Jenis Role</label>
                                                <input name="jenis_role" type="text" class="form-control {{$errors->has('jenis_role') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{old('jenis_role')}}"  oninvalid="this.setCustomValidity('Jenis role tidak boleh kosong')" oninput="setCustomValidity('')"/>
                                                @if($errors->has('jenis_role'))
        <p class="text-danger">{{ $errors->first('jenis_role') }}</p>
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