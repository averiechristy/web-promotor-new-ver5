@extends('layouts.user.app2')

@section('content2')

  <!-- ======= Edit Profil Section ======= -->

  <main id ="main">
  <section id="cobakalku" class="cobakalku d-flex align-items-center">
        <div class="container">
  
          <div class="row justify-content-between">
          <div class="col-lg-6 pt-5 pt-lg-0 form-edit">

          <form action="{{ route('hitung') }}" method="post" role="form" class="php-email-form1" id="calculator-form">
@csrf

         <h4>Masukan kebutuhan cicilanmu</h4>
          <div id="input-fields">
                    <div class="input-field">
                               

               
            <div class="mb-3 mt-4">
            <label for="email">Jenis Barang</label>
            
            <select style="width: 470px;" class="form-select" name="nama_barang[]" required>
    <option value="" selected disabled>-- Pilih Barang --</option>
    <option value="motor" {{ old('nama_barang.0') == 'motor' ? 'selected' : '' }}>Motor</option>
    <option value="mobil" {{ old('nama_barang.0') == 'mobil' ? 'selected' : '' }}>Mobil</option>
    <option value="rumah" {{ old('nama_barang.0') == 'rumah' ? 'selected' : '' }}>Rumah</option>
    <option value="other" {{ old('nama_barang.0') == 'other' ? 'selected' : '' }}>Other</option>
</select>


        </div>

        <div class="mb-3">
          
        <input type="text" name="nama_barang_other[]" style="width: 470px;" placeholder="Masukan nama barang lain" class="form-control" id="nama_barang_other_0" value="{{ old('nama_barang_other.0', $formInput['nama_barang_other.0'] ?? '') }}">
            
        </div>

        <div class="mb-3">

            <label for="cicilan">Cicilan</label>
            <input type="number" min="1" name="cicilan[]" style="width: 470px;" class="form-control" required value="{{ old('cicilan.0') }}">
            
        </div>
        </div>
        </div>

<button type="button" class="btn btn-primary btn-sm" id="add-field">Tambah Barang</button>
        <br><br>
                
                <br><br>

             
            </div>

            
            
      
            <div class="col-lg-6 pt-5 pt-lg-0 form-edit">
            @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

            <div id="form-sales-skills">
                <h4>Kamu lebih jago penjualan apa</h4>
                <form id="sales-skills-form">
                   
                @foreach ($barang as $barang)
    <div class="col-auto">
        <label for="inputPassword6" class="col-form-label">{{ $barang->nama_produk }} </label>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-auto">
        <input type="number" class="form-control" style="width: 430px" name="product_persen[{{ $barang->id }}]" min="0" id="input-expression_{{ $barang->id }}" value="{{ old('product_persen.' . $barang->id) }}">
        </div>
        <div class="col-auto">
            <span id="" class="form-text">
                %
            </span>
        </div>
    </div>
@endforeach
          </div>
        </div>

        <button class="btn btn-success btn-sm mt-3 mx-auto" style="width: 50%;" type="submit">Hitung Jumlah Produk</button>
      
        @if (session('totalCicilan') && session('totalPoin') && session('jumlahProduk'))
    @php
        $totalCicilan = session('totalCicilan');
        $totalPoin = session('totalPoin');
        $jumlahProduk = session('jumlahProduk');
    @endphp


          <div class="alert alert-info mt-3">
   Asumsikan ditambahkan senilai Rp. 3.000.000 dari total cicilan untuk kebutuhan harianmu ya.
</div>

  
  <label for="name">Hasil</label>
  <?php
    $formattedHasil = 'Rp. ' . number_format($totalCicilan, 0, ',', '.') . ',-';
    ?>

                            <input class="form-control font-weight-bold" style="  font-weight: bold;" type="text" value=" {{ $formattedHasil }}" aria-label="Rp. 0,-" disabled readonly>  
 
  <label for="name">Jumlah Poin</label>
                            <input class="form-control font-weight-bold"   style="font-weight: bold;" type="text" value="{{$totalPoin}} poin" aria-label="0 poin"  disabled readonly> 





    
    <div id="form-jumlah-produk">
        <h2>Jumlah Produk:</h2>
        <ul>
            @foreach ($jumlahProduk as $productId => $jumlah)
                @php
                    $product = \App\Models\Product::find($productId); // Gantilah '\App\Product' dengan namespace aktual model Produk Anda
                    $productName = $product->nama_produk;
                @endphp
                <li>
                    <span class="product-name">{{ $productName }}</span>:
                    <span class="product-quantity">{{ $jumlah }}</span>
                </li>
            @endforeach
        </ul>
        </div>
        @php
        session()->forget('totalCicilan');
        session()->forget('totalPoin');
        session()->forget('jumlahProduk');
    @endphp
@endif


        </form>

        
      </section><!-- End Edit Profil Section -->
  
</main>
      @endsection

      <script>
document.addEventListener("DOMContentLoaded", function () {
    
    const selectInputs = document.querySelectorAll("select[name='nama_barang[]']");
    const otherInputFields = document.querySelectorAll("input[name^='nama_barang_other']");
    

    function toggleOtherInput(index) {
        const selectInputs = document.querySelectorAll("select[name='nama_barang[]']");
        const otherInputFields = document.querySelectorAll("input[name^='nama_barang_other']");

        const selectedOption = selectInputs[index].value;
        if (selectedOption === "other") {
            otherInputFields[index].style.display = "block";
        } else {
            otherInputFields[index].style.display = "none";
            otherInputFields[index].value = ""; // Reset input "nama_barang_other"
        }
    }

    selectInputs.forEach((select, index) => {
        select.addEventListener("change", () => {
            toggleOtherInput(index);
        });

        // Set initial state based on the current select value
        toggleOtherInput(index);
    });

    
    function updateSelectChangeListeners() {
        const selectInputs = document.querySelectorAll("select[name='nama_barang[]']");
        selectInputs.forEach((select, index) => {
            select.addEventListener("change", () => {
                toggleOtherInput(index);
            });

            // Set initial state based on the current select value
            toggleOtherInput(index);
        });
    }


    const addButton = document.getElementById("add-field");
    const inputFieldsContainer = document.getElementById("input-fields");
    const inputFieldTemplate = document.querySelector(".input-field").cloneNode(true);

    addButton.addEventListener("click", function () {
        const newInputField = inputFieldTemplate.cloneNode(true);
        inputFieldsContainer.appendChild(newInputField);

        // Tambahkan tombol "Hapus" di setiap input-field
        const deleteButton = document.createElement("button");
        deleteButton.innerText = "Hapus";
        deleteButton.className = "btn btn-danger btn-sm mb-2";
        deleteButton.addEventListener("click", function () {
            inputFieldsContainer.removeChild(newInputField);
            updateSelectChangeListeners(); // Update select change listeners after removing an input field
        });
        newInputField.appendChild(deleteButton);

        updateSelectChangeListeners(); // Update select change listeners for the newly added input field
    });

    // Initialize select change listeners for existing input fields
    updateSelectChangeListeners();
});

      </script>

<style>
    #form-jumlah-produk {
        margin-top: 20px;
        padding: 10px;
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        border-radius: 5px;
    }


    .product-quantity {
        color: #01004C;
        font-weight: bold;/* Warna teks biru, bisa disesuaikan */
    }
</style>
