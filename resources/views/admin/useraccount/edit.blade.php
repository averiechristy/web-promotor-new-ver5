@extends('layouts.admin.app')

@section('content')



<div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Edit User Akun
                                    </div>
                                    <div class="card-body">
                                       <form name="saveform" action="/updateuser/{{$data->id}}" method="post" onsubmit="return validateForm()">
                                            @csrf

                                            <div class="form-group mb-4">
    <label for="" class="form-label">Pilih Akses</label>
    <select name="akses_id" class="form-control {{ $errors->has('akses_id') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-label=".form-select-lg example" oninvalid="this.setCustomValidity('Pilih salah satu akses')" oninput="setCustomValidity('')">
        <option value="" selected disabled>-- Pilih Akses --</option>
        @foreach ($akses as $item)
            <option value="{{ $item->id }}" {{ old('akses_id', $data->akses_id) == $item->id ? 'selected' : '' }}>
                {{ $item->jenis_akses }}
            </option>
        @endforeach
    </select>
    @if($errors->has('akses_id'))
        <p class="text-danger">{{ $errors->first('akses_id') }}</p>
    @endif
</div>
<div class="form-group mb-4">
    <label for="" class="form-label">Kode Role</label>
    <select name="role_id" class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-label=".form-select-lg example" oninvalid="this.setCustomValidity('Pilih salah satu role')" oninput="setCustomValidity('')" >
        <option selected disabled>-- Pilih Kode Role --</option>
        @if($data->akses_id) {{-- Pastikan ada akses yang terpilih --}}
            @foreach ($roles[$data->akses_id] as $role) {{-- Menggunakan $data->akses_id --}}
                <option value="{{ $role->id }}" {{ old('role_id', $data->role_id) == $role->id ? 'selected' : '' }}>
                    {{ $role->kode_role }} - {{ $role->jenis_role }}
                </option>
            @endforeach
        @endif
    </select>
    @if($errors->has('role_id'))
        <p class="text-danger">{{ $errors->first('role_id') }}</p>
    @endif
</div>


<script>
    const roles = {!! json_encode($roles) !!};
    const selectedAksesId = {!! json_encode(old('akses_id')) !!};
    const selectedRoleId = {!! json_encode(old('role_id')) !!};

    const aksesDropdown = document.querySelector('select[name="akses_id"]');
    const roleDropdown = document.querySelector('select[name="role_id"]');
    
    aksesDropdown.addEventListener('change', function() {
        const selectedAksesId = this.value;
        roleDropdown.innerHTML = '<option selected disabled>-- Pilih Kode Role --</option>';
        
        if (roles[selectedAksesId]) {
            roles[selectedAksesId].forEach(role => {
                const option = document.createElement('option');
                option.value = role.id;
                option.textContent = `${role.kode_role} - ${role.jenis_role}`;
                if (role.id === selectedRoleId) {
                    option.selected = true;
                }
                roleDropdown.appendChild(option);
            });
        }
    });

    // Set selected options on initial page load
    // if (selectedAksesId && roles[selectedAksesId]) {
    //     roles[selectedAksesId].forEach(role => {
    //         const option = document.createElement('option');
    //         option.value = role.id;
    //         option.textContent = `${role.kode_role} - ${role.jenis_role}`;
    //         if (role.id === selectedRoleId) {
    //             option.selected = true;
    //         }
    //         roleDropdown.appendChild(option);
    //     });
    // }
</script>

             
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Nama</label>
                                                <input name="nama" type="text" class="form-control {{$errors->has('nama') ? 'is-invalid' : ''}}" style="border-color: #01004C;" value="{{ old('nama', $data->nama) }}" oninvalid="this.setCustomValidity('Nama user tidak boleh kosong')" oninput="setCustomValidity('')"  />
                                                @if ($errors->has('nama'))
                                                    <p class="text-danger">{{$errors->first('nama')}}</p>
                                                @endif
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Kode Sales</label>
                                                <input name="username" type="text" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{ old('username', $data->username) }}" oninvalid="this.setCustomValidity('Kode sales (Username) tidak boleh kosong')" oninput="setCustomValidity('')" />
                                                @if ($errors->has('username'))
                                                    <p class="text-danger">{{$errors->first('username')}}</p>
                                                @endif
                                            </div>

                                           

                                              <div class="form-group mb-4">
                                                <label for="" class="form-label">Email</label>
                                                <input name="email" type="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{ old('email', $data->email) }}"required oninvalid="this.setCustomValidity('Format email harus benar')" oninput="setCustomValidity('')" />
                                                @if ($errors->has('email'))
                                                    <p class="text-danger">{{$errors->first('email')}}</p>
                                                @endif
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">No Handphone</label>
                                                <input name="phone_number" type="number" class="form-control {{$errors->has('phone_number') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{ old('phone_number', $data->phone_number) }}" oninvalid="this.setCustomValidity('Nomor handphone tidak boleh kosong')" oninput="setCustomValidity('')" />
                                                @if ($errors->has('phone_number'))
                                                    <p class="text-danger">{{$errors->first('phone_number')}}</p>
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
  let koderole = document.forms["saveform"]["role_id"].value;
  let nama = document.forms["saveform"]["nama"].value;
  let email = document.forms["saveform"]["email"].value;
  let username = document.forms["saveform"]["username"].value;
  let phonenumber = document.forms["saveform"]["phone_number"].value;


  if (akses == "") {
    alert("Akses tidak boleh kosong");
    return false;
  } else   if (koderole == "") {
    alert("Kode role tidak boleh kosong");
    return false;
  } else   if (nama == "") {
    alert("Nama user tidak boleh kosong");
    return false;
  }else   if (email == "") {
    alert("Email tidak boleh kosong");
    return false;
}else   if (username == "") {
    alert("Kode Sales (Username) tidak boleh kosong");
    return false;

}else   if (phonenumber == "") {
    alert("Nomor handphone tidak boleh kosong");
    return false;
}
}

</script>


@endsection