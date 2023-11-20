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
                <h5 class="card-title">Total Cicilan</h5>
                <input class="form-control font-weight-bold" style="font-weight: bold;" type="text" value="{{ $formattedHasil }}" aria-label="Rp. 0,-" disabled>
            </div>
        </div>
    </div>
    
</div>

    
    <div id="form-jumlah-produk" >
        <h5 class="mt-3">Jumlah Produk yang harus dijual:</h5>
        <div class="row">

        <h6>Jumlah Produk NTB Reguler</h6>
        <ul>
            @foreach($jumlahProdukntb as $productId => $jumlah)
                <li>{{ $product->find($productId)->nama_produk }}: {{ $jumlah }}</li>
            @endforeach
        </ul>

        <h6>Jumlah Produk Sosmed</h6>
        <ul>
            @foreach($jumlahProduksosmed as $productId => $jumlah)
                <li>{{ $product->find($productId)->nama_produk }}: {{ $jumlah }}</li>
            @endforeach
        </ul>

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
