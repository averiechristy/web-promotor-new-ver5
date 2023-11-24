@extends('layouts.user.app2')

@section('content2')



    <!-- ======= Services Section ======= -->
    <main id="main2">
    <section id="services" class="services d-flex align-items-center">
      <div class="container" >

        
   
        <div class="row">
       
      
        


          <div class="alert alert-info mt-3">
   Asumsikan ditambahkan senilai Rp. 3.000.000 dari total cicilan untuk kebutuhan harianmu ya.
</div>

<?php
    $formattedHasil = 'Rp. ' . number_format($totalCicilan, 0, ',', '.') . ',-';
    ?>
<div class="row mt-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Kebutuhan bulanan dan cicilan</h5>
                <input class="form-control font-weight-bold" style="font-weight: bold;" type="text" value="{{ $formattedHasil }}" aria-label="Rp. 0,-" disabled>
            </div>
        </div>
    </div>
   
</div>

    
    <div id="form-jumlah-produk" >
        <h5 class="mt-3">Jumlah Produk yang harus dijual:</h5>
        <p> <small style="color:red;">Asumsi jika dalam 1 bulan menjual minimal 5 aplikasi per minggu</small></p>

        <div class="row">

            @foreach ($jumlahProduk as $productId => $jumlah)
                @php
                    $product = \App\Models\Product::find($productId); // Gantilah '\App\Product' dengan namespace aktual model Produk Anda
                    $productName = $product->nama_produk;
                    $productImage = $product->gambar_produk;
                @endphp
                <!-- <li>
                    <span class="product-name">{{ $productName }}</span>:
                    <span class="product-quantity">{{ $jumlah }}</span>
                </li> -->

                <div class="col-md-6 col-lg-3 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon">                    
                <img src="{{ asset('img/' .$productImage) }}" class="card-img-top" style="object-fit: cover; height: 250px;" alt="...">
              </div>
              <h4 class="title"><span class="jumlah">{{ $jumlah }}</span> - {{ $productName }}</h4>
            </div>
          </div>

          
            @endforeach
            <div class="text-center">
    <button class="btn btn-primary btn-sm" style="width: 50%;" type="button" onclick="goBack()">Hitung ulang produk</button>
</div>

<script>
function goBack() {
    window.history.back();
}
</script>

<style>
    .jumlah {
    font-size: 1.5em; /* Ganti sesuai keinginan Anda */
    /* Atau gunakan nilai font-size yang sesuai */
}

</style>

       <div>


        </div>
       

        </form>  
      </section><!-- End Edit Profil Section -->
  
</main>
    

@endsection
