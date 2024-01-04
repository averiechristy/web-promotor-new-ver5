@extends('layouts.admin.app')
@section('content')
                <!-- Begin Page Content -->
                    <div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                    Tambah Skema Baru
                                    </div>
                                    <div class="card-body">
                                       <form name="saveform" action="{{route('admin.skema.simpan')}}"  enctype="multipart/form-data" method="post"  onsubmit="return validateForm()">
                                             @csrf
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
                                                <label for="" class="form-label">Produk</label>
                                            <select name="produk_id" class="form-control {{ $errors->has('produk_id') ? 'is-invalid' : '' }} product-select" style="border-color: #01004C;" aria-label=".form-select-lg example"oninvalid="this.setCustomValidity('Pilih salah satu role')" oninput="setCustomValidity('')">
                                                <option value="" disabled selected>-- Pilih Produk--</option>
                                                <!-- @foreach ($produk as $item)
                                                    <option value="{{ $item->id }}"{{ old('produk_id') == $item->id ? 'selected' : '' }}> {{ $item->nama_produk}}</option>
                                                @endforeach -->
                                            </select> 
                                            @if ($errors->has('produk_id'))
                                                <p class="text-danger">{{ $errors->first('produk_id') }}</p>
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
                                            <div class="form-check form-switch">
    <input class="form-check-input switch" type="checkbox" role="switch" id="flexSwitchCheckChecked" onclick="toggleFormPoin()">
    <label class="form-check-label" for="flexSwitchCheckChecked">Konversi Poin</label>
</div>
</div>
                                            
<div id="formpoin" class="form-group mb-4" style="display: none;">
  <label for="exampleFormControlInput1" class="form-label">Poin Produk</label>
  <input type="text" name="poin_produk" class="form-control" id="exampleFormControlInput1">
</div>

                    

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



<div class="insentif-container"> 

<div class="insentif-item"> 
                                            <div class="form-row">
    <div class="col-6">
    <label for="" class="form-label">Insentif</label>

      <input type="number"  name ="insentif[]" class="form-control" >
    </div>
    <div class="col">
    <label for="" class="form-label">Minimal Qty</label>

      <input type="number" min="1" name ="min_qty[]" class="form-control" >
    </div>
    <div class="col">
    <label for="" class="form-label">Maksimal Qty</label>

      <input type="number" min="1" name="max_qty[]" class="form-control" >
    </div>
    <div class="col-2 mt-2">
    <label for="" class="form-label"></label>

    <button type="button" class="form-control btn btn-danger btn-sm" id="remove-insentif">Delete</button>
    </div>
  </div>

  </div>
  </div>

  <div class="form-group mb-4 mt-2">
  <button type="button" class="btn btn-success btn-sm" id="add-insentif">Tambah Insentif</button>
</div>
 <div class="form-group mb-4">
                                                <label for="" class="form-label">Keterangan</label>
                                                <textarea name="keterangan" type="text" class="form-control {{$errors->has('keterangan') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" oninvalid="this.setCustomValidity('Deskripsi produk tidak boleh kosong')" oninput="setCustomValidity('')">{{old('keterangan')}}</textarea>

                                                @if ($errors->has('keterangan'))
                                                    <p class="text-danger">{{$errors->first('keterangan')}}</p>
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




        <script>
    $(document).ready(function() {
    



    var initialRoleId = $('#role').val();
    var initialProductId = $('.product-select').eq(0).val();
    if (initialRoleId) {
        fillProductOptions(initialRoleId, $('.product-select'));
    }
    
        $('#role').change(function() {
            var roleId = $(this).val();
            $.ajax({
                url: '/getProduct/' + roleId,
                type: 'GET',
                success: function(data) {
                    var productsSelect = $('.product-select');
                    
                    productsSelect.empty();
                    $.each(data, function(key, produk) {
                        productsSelect.append('<option value="'+ produk.id +  '">' + produk.nama_produk + '</option>');                  

                    });
                }
            });
        });

    });

    
    </script>   


<script>
    $(document).ready(function () {
        // ... (kode JavaScript sebelumnya) ...

        // Fungsi untuk menambah insentif
        $('#add-insentif').click(function () {
            var insentifContainer = $('.insentif-container');
            var newInsentifItem = $('.insentif-item').eq(0).clone();

            // Mengosongkan nilai input pada item baru
            newInsentifItem.find('input').val('');

            // Menambah item insentif baru ke dalam kontainer
            insentifContainer.append(newInsentifItem);
        });

        // Fungsi untuk menghapus insentif
        $(document).on('click', '#remove-insentif', function () {
            var insentifContainer = $('.insentif-container');
            var insentifItems = insentifContainer.find('.insentif-item');

            // Memastikan ada lebih dari satu item sebelum menghapus
            if (insentifItems.length > 1) {
                $(this).closest('.insentif-item').remove();
            }
            else {
                alert("Anda tidak dapat menghapus form insentif pertama.");
            }
        });
    });
</script>
    @endsection

