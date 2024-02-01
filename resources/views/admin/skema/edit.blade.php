@extends('layouts.admin.app')
@section('content')
                <!-- Begin Page Content -->
                    <div class="container">
                        <div class="row">
                        <div class="col-12 ">
                                <div class="card mt-3">
                                    <div class="card-header">
                                    Tambah Skema Baru
                                    </div>
                                    <div class="card-body">
                                       <form name="saveform"  action="/updateskema/{{$skema->id}}" enctype="multipart/form-data" method="post"  onsubmit="return validateForm()">
                                             @csrf
                                             <div class="form-group mb-4">
    <label for="" class="form-label">Kode Role</label>
    <select id="role" name="role_id" class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" style="border-color: #01004C;" aria-label=".form-select-lg example" oninvalid="this.setCustomValidity('Pilih salah satu role')" oninput="setCustomValidity('')">
        <option value="" disabled>-- Pilih Kode Role--</option>
        
        @foreach ($role as $item)
            @if ($item->Akses->jenis_akses === 'User')
                <option value="{{ $item->id }}"{{ $item->id == old('role_id', $selectedRoleId) ? 'selected' : '' }}> {{ $item->kode_role }} - {{ $item->jenis_role }}</option>
            @endif
        @endforeach
    </select> 
    @if ($errors->has('role_id'))
        <p class="text-danger">{{ $errors->first('role_id') }}</p>
    @endif
</div>


                                            
<div class="form-group mb-4">
    <label for="" class="form-label">Produk</label>
    <select name="produk_id" class="form-control {{ $errors->has('produk_id') ? 'is-invalid' : '' }} product-select" style="border-color: #01004C;" aria-label=".form-select-lg example" oninvalid="this.setCustomValidity('Pilih salah satu role')" oninput="setCustomValidity('')">
        <option value="" disabled>-- Pilih Produk--</option>
        @foreach ($produk as $item)
        @if ($item->role_id == $selectedRoleId)
        <option value="{{ $item->id }}" {{ $selectedProductId == $item->id ? 'selected' : '' }}>
    {{ $item->nama_produk }}
</option>

            @endif        @endforeach
    </select>
    @if ($errors->has('produk_id'))
        <p class="text-danger">{{ $errors->first('produk_id') }}</p>
    @endif
</div>

                                            <div class="form-group mb-4">
    <label for="tanggal_mulai">Tanggal Mulai</label>
    @php
        $sekarang = now()->format('Y-m-d');
    @endphp

    @if ($sekarang >= $skema->tanggal_mulai && $sekarang <= $skema->tanggal_selesai)
        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $skema->tanggal_mulai) }}" readonly>
        <small class="text-muted">Tanggal Mulai tidak dapat diubah karena status sedang berjalan.</small>
    @else
        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $skema->tanggal_mulai) }}" required>
    @endif
</div>


<div class="form-group mb-4">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', isset($skema) ? $skema->tanggal_selesai : '') }}" required>
                        </div>

                        <div class="form-group mb-4">
    <div class="form-check form-switch">
        <input class="form-check-input switch" type="checkbox" role="switch" id="flexSwitchCheckChecked" onclick="toggleFormPoin()" {{ $skemaHasPoinProduk ? 'checked' : '' }}>
        <label class="form-check-label" for="flexSwitchCheckChecked">Konversi Poin</label>
    </div>
</div>

<div id="formpoin" class="form-group mb-4" style="display: {{ $skemaHasPoinProduk ? 'block' : 'none' }}">
    <label for="exampleFormControlInput1" class="form-label">Poin Produk</label>
    <input type="text" name="poin_produk" class="form-control" id="exampleFormControlInput1" value="{{ $skema->poin_produk }}">
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
@foreach ($nama as $detailData)
@foreach(old('skema', ['']) as $index => $oldProduct)


<div class="insentif-item"> 
                                            <div class="form-row">
    <div class="col-4">
    <label for="" class="form-label">Insentif</label>

      <input type="number"  name ="insentif[]" value="{{ old('insentif.'.$index, $detailData->insentif) }}" class="insentif-input form-control" oninput="validasiNumber(this)" required >
    </div>
    <div class="col">
    <label for="" class="form-label">Allowance</label>

      <input type="number"  name ="allowance[]" value="{{ old('allowance.'.$index, $detailData->allowance) }}" class="allowance-input form-control" oninput="validasiNumber(this)" required>
    </div>
    <div class="col">
    <label for="" class="form-label">Minimal Qty</label>

      <input type="number"  name ="min_qty[]" value="{{ old('min_qty.'.$index, $detailData->min_qty) }}" class="min_qty-input form-control" oninput="validasiNumber(this)" >
    </div>
    <div class="col">
    <label for="" class="form-label">Maksimal Qty</label>

      <input type="number"  name="max_qty[]"  value="{{ old('max_qty.'.$index, $detailData->max_qty) }}" class="max_qty-input form-control" oninput="validasiNumber(this)">
    </div>


    <div class="form-group mb-4">
    <label for="" class="form-label">Status</label>
    <select name="status[]" class="form-select" aria-label="Default select example" required>
        <option value="" disabled>Pilih Status</option>
        <option value="Aktif" @if(old('status.'.$index, $detailData->status) == 'Aktif') selected @endif>Aktif</option>
        <option value="Tidak Aktif" @if(old('status.'.$index, $detailData->status) == 'Tidak Aktif') selected @endif>Tidak Aktif</option>
    </select>
</div>

    <div class="col-2 mt-2">
    <label for="" class="form-label"></label>
    

    <button type="button" class="form-control btn btn-danger btn-sm remove-insentif" id="remove-insentif">Delete</button>
    </div>
  </div>

  </div>
  @endforeach
  @endforeach
  </div>

  <div class="form-group mb-4 mt-2">
  <button type="button" class="btn btn-success btn-sm add-insentif" id="add-insentif">Tambah Insentif</button>
</div>
 <!-- <div class="form-group mb-4">
                                                <label for="" class="form-label">Keterangan</label>
                                                <textarea name="keterangan" type="text" class="form-control {{$errors->has('keterangan') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{ old('keterangan', $skema->keterangan) }}" oninvalid="this.setCustomValidity('Deskripsi produk tidak boleh kosong')" oninput="setCustomValidity('')">{{old('keterangan', $skema->keterangan)}}</textarea>

                                                @if ($errors->has('keterangan'))
                                                    <p class="text-danger">{{$errors->first('keterangan')}}</p>
                                                @endif
                                            </div> -->

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
function validasiNumber(input) {
    // Hapus karakter titik (.) dari nilai input
    input.value = input.value.replace(/\./g, '');

    // Pastikan hanya karakter angka yang diterima
    input.value = input.value.replace(/\D/g, '');
}
</script>
        <script>
    $(document).ready(function() {

        $('#role').change(function() {
            var roleId = $(this).val();
            $.ajax({
                url: '/getProduct/' + roleId,
                type: 'GET',
                success: function(data) {
                    var productsSelect = $('.product-select');
                    
                    productsSelect.empty();
                    $.each(data, function(key, produk) {
                        productsSelect.append('<option value="'+ produk.id +  '">'  + produk.nama_produk + '</option>');                  

                    });
                }
            });
        });

    });

    
    </script>   


<script>

function saveProductData() {
    var productData = [];
    $('.insentif-item').each(function() {
        var insentifInput = $(this).find('.insentif-input');
        var insentif = insentifInput.val();

        var minqtyInput = $(this).find('.min_qty-input');
        var minqty = minqtyInput.val();

        var maxqtyInput = $(this).find('.max_qty-input');
        var maxqty = maxqtyInput.val();

        var allowanceInput = $(this).find('.allowance-input');
        var allowance = allowanceInput.val();

        productData.push({  insentif: insentif, minqty: minqty, allowance: allowance });
    });
    localStorage.setItem('productData', JSON.stringify(productData));
}

$(document).ready(function() {
    // ...

    // Event handler untuk menambah produk
    $('.add-insentif').click(function() {
        // ...
        saveProductData();
    });

    // Event handler untuk menghapus produk
    $(document).on('click', '.remove-insentif', function() {
        // ...
        saveProductData();
    });

    // ...
});




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
            saveProductData();
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
            saveProductData();
        });

        $(document).on('input', '.insentif-item input[name="min_qty[]"], .insentif-item input[name="max_qty[]"]', function () {
    var insentifItems = $('.insentif-container').find('.insentif-item');
    var previousMinQtyValues = []; // Menyimpan nilai min_qty sebelumnya
    var previousMaxQtyValues = []; // Menyimpan nilai max_qty sebelumnya

    // Memastikan nilai min_qty dan max_qty berbeda
    insentifItems.each(function () {
        var minQtyInput = $(this).find('input[name="min_qty[]"]');
        var maxQtyInput = $(this).find('input[name="max_qty[]"]');
        
        var minQty = minQtyInput.val();
        var maxQty = maxQtyInput.val();

        // Memeriksa apakah nilai minQty atau maxQty sudah diinput sebelumnya
        if (previousMinQtyValues.includes(minQty) || previousMaxQtyValues.includes(maxQty)) {
            alert("Nilai Min Qty atau Max Qty tidak boleh sama dengan nilai sebelumnya.");
            
            // Mengosongkan nilai yang menyebabkan kesalahan
            minQtyInput.val('');
            maxQtyInput.val('');
        } else  if (previousMinQtyValues.includes(maxQty) || previousMaxQtyValues.includes(minQty)) {
            alert("Nilai Min Qty atau Max Qty tidak boleh sama dengan nilai sebelumnya.");
            
            // Mengosongkan nilai yang menyebabkan kesalahan
            minQtyInput.val('');
            maxQtyInput.val('');
        } else if (minQty !== '' && maxQty !== '' && parseInt(minQty) >= parseInt(maxQty)) {
            alert("Nilai Max Qty harus lebih besar dari Min Qty atau Tidak boleh sama.");
            
            // Mengosongkan nilai yang menyebabkan kesalahan
            minQtyInput.val('');
            maxQtyInput.val('');
        } else {
            // Menyimpan nilai min_qty dan max_qty untuk pengecekan selanjutnya
            previousMinQtyValues.push(minQty);
            previousMaxQtyValues.push(maxQty);
        }
    });
});
    });
</script>


<script>
function validateForm() {
  let koderole = document.forms["saveform"]["role_id"].value;
  let produk = document.forms["saveform"]["produk_id"].value;
let tanggalmulai = document.forms["saveform"]["tanggal_mulai"].value;
let tanggalselesai = document.forms["saveform"]["tanggal_selesai"].value;
let keterangan = document.forms["saveform"]["keterangan"].value;


    if (koderole == "") {
    alert("Kode role tidak boleh kosong");
    return false;
  } else   if (produk == "") {
    alert("Produk tidak boleh kosong");
    return false;
  } else   if (tanggalmulai == "") {
    alert("Tanggal Mulai tidak boleh kosong");
    return false;
  }
    else   if (tanggalselesai == "") {
    alert("Tanggal Selesai tidak boleh kosong");
    return false;
    }else   if (keterangan == "") {
    alert("Keterangan tidak boleh kosong");
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
    @endsection

