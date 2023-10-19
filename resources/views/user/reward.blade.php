@extends('layouts.user.app2')

@section('content2')

<main id="main">
  <section id="portfolio" class="portfolio">
    <div class="container">

      <div class="section-title">
        <h2></h2>
        <p>Reward</p>
      </div>

      <div class="row" data-aos-delay="100">
        <div class="col-lg-12">
          <ul id="portfolio-flters">
            <li data-filter=".filter-card" class="filter-active">Sedang Berjalan</li>
            <li data-filter=".filter-web">Akan Datang</li>
            <li data-filter=".filter-app">Berakhir</li>

          </ul>
        </div>
      </div>

<div class="container" >       
  
<!--  -->
        <div class="row portfolio-container"  data-aos-delay="200">

        @php
    $today = now(); // Ambil tanggal saat ini
  @endphp

  @foreach ($reward as $rewardItem)
    @php
      $startDate = \Carbon\Carbon::parse($rewardItem->tanggal_mulai);
      $endDate = \Carbon\Carbon::parse($rewardItem->tanggal_selesai);
    @endphp

    @if ($today->gte($startDate) && $today->lte($endDate))
      <!-- Tampilkan reward yang berada dalam periode tanggal mulai dan tanggal selesai -->
      <div class="col-lg-4 portfolio-item filter-card">
      <div class="card-style" data-toggle="modal" data-target="#rewardModal{{ $rewardItem->id }}">

@php
$selesai = \Carbon\Carbon::parse($rewardItem->tanggal_selesai)->endOfDay();
$mulai = \Carbon\Carbon::parse($rewardItem->tanggal_mulai);
$sekarang = \Carbon\Carbon::now();

if ($selesai->isPast()) {
  echo '<span class="badge badge-gray" style="color:white; background-color:gray;">Berakhir</span>';
} elseif ($sekarang >= $mulai && $sekarang <= $selesai) {
  echo '<span class="badge badge-success">Sedang Berjalan</span>';
} elseif ($sekarang < $mulai) {
  echo '<span class="badge badge-info">Akan Datang</span>';
} else {
  echo '<span class="badge badge-danger">Berakhir</span>';
}
@endphp

  <img class="card-img-top mt-3" src="{{asset('img/'.$rewardItem->gambar_reward)}}" alt="{{ $rewardItem->title }}">
  <div class="card-body mt-3">
      <h5 class="card-title">{{ $rewardItem->judul_reward }}</h5>
      <p class="card-text">Kumpulkan poin : {{ $rewardItem->poin_reward }}</p>
<?php
// Mendapatkan tanggal mulai dan tanggal selesai dari $rewardItem
$tanggal_mulai = $rewardItem->tanggal_mulai;
$tanggal_selesai = $rewardItem->tanggal_selesai;

// Mengubah format tanggal dari yyyy-mm-dd menjadi dd-mm-yyyy
$tanggal_mulai = date("d-m-Y", strtotime($tanggal_mulai));
$tanggal_selesai = date("d-m-Y", strtotime($tanggal_selesai));
?>

<p class="card-text"><small class="text-muted">Periode: <?php echo $tanggal_mulai; ?> - <?php echo $tanggal_selesai; ?></small></p>
    </div>
  </div>

</div>

<div class="modal fade" id="rewardModal{{ $rewardItem->id }}" tabindex="-1" role="dialog" aria-labelledby="rewardModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="rewardModalLabel">{{ $rewardItem->judul_reward }}</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="modal-body">
<img src="{{ asset('img/'.$rewardItem->gambar_reward) }}" alt="Gambar Reward" id="gambarmodal">
  <!-- Isi modal dengan informasi dari $rewardItem -->

  <p class="card-text mt-2">Kumpulkan poin : {{ $rewardItem->poin_reward }}</p>
  <p class="card-desc mt-2">{!! nl2br(e($rewardItem->deskripsi_reward)) !!}</p>
<?php
// Mendapatkan tanggal mulai dan tanggal selesai dari $rewardItem
$tanggal_mulai = $rewardItem->tanggal_mulai;
$tanggal_selesai = $rewardItem->tanggal_selesai;

// Mengubah format tanggal dari yyyy-mm-dd menjadi dd-mm-yyyy
$tanggal_mulai = date("d-m-Y", strtotime($tanggal_mulai));
$tanggal_selesai = date("d-m-Y", strtotime($tanggal_selesai));
?>

<p class="card-text"><small class="text-muted">Periode: <?php echo $tanggal_mulai; ?> - <?php echo $tanggal_selesai; ?></small></p>
  <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
</div>
<div class="modal-footer">
  <!-- Tambahkan tombol atau aksi lainnya sesuai kebutuhan -->
</div>
</div>
</div>      </div>
    @endif


    @if ($today->lt($startDate))
          <!-- Tampilkan reward yang berada dalam periode tanggal mulai dan tanggal selesai -->
      <div class="col-lg-4 portfolio-item filter-web">
      <div class="card-style" data-toggle="modal" data-target="#rewardModal{{ $rewardItem->id }}">

@php
$selesai = \Carbon\Carbon::parse($rewardItem->tanggal_selesai)->endOfDay();
$mulai = \Carbon\Carbon::parse($rewardItem->tanggal_mulai);
$sekarang = \Carbon\Carbon::now();

if ($selesai->isPast()) {
  echo '<span class="badge badge-gray" style="color:white; background-color:gray;">Berakhir</span>';
} elseif ($sekarang >= $mulai && $sekarang <= $selesai) {
  echo '<span class="badge badge-success">Sedang Berjalan</span>';
} elseif ($sekarang < $mulai) {
  echo '<span class="badge badge-info">Akan Datang</span>';
} else {
  echo '<span class="badge badge-danger">Berakhir</span>';
}
@endphp

  <img class="card-img-top mt-3" src="{{asset('img/'.$rewardItem->gambar_reward)}}" alt="{{ $rewardItem->title }}">
  <div class="card-body mt-3">
      <h5 class="card-title">{{ $rewardItem->judul_reward }}</h5>
      <p class="card-text">Kumpulkan poin : {{ $rewardItem->poin_reward }}</p>
      <?php
// Mendapatkan tanggal mulai dan tanggal selesai dari $rewardItem
$tanggal_mulai = $rewardItem->tanggal_mulai;
$tanggal_selesai = $rewardItem->tanggal_selesai;

// Mengubah format tanggal dari yyyy-mm-dd menjadi dd-mm-yyyy
$tanggal_mulai = date("d-m-Y", strtotime($tanggal_mulai));
$tanggal_selesai = date("d-m-Y", strtotime($tanggal_selesai));
?>

<p class="card-text"><small class="text-muted">Periode: <?php echo $tanggal_mulai; ?> - <?php echo $tanggal_selesai; ?></small></p>
    </div>
  </div>
</div>



<div class="modal fade" id="rewardModal{{ $rewardItem->id }}" tabindex="-1" role="dialog" aria-labelledby="rewardModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="rewardModalLabel">{{ $rewardItem->judul_reward }}</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="modal-body">
<img src="{{ asset('img/'.$rewardItem->gambar_reward) }}" alt="Gambar Reward" id="gambarmodal">
  <!-- Isi modal dengan informasi dari $rewardItem -->

  <p class="card-text mt-2">Kumpulkan poin : {{ $rewardItem->poin_reward }}</p>
  <p class="card-desc mt-2">{!! nl2br(e($rewardItem->deskripsi_reward)) !!}</p>
  <?php
// Mendapatkan tanggal mulai dan tanggal selesai dari $rewardItem
$tanggal_mulai = $rewardItem->tanggal_mulai;
$tanggal_selesai = $rewardItem->tanggal_selesai;

// Mengubah format tanggal dari yyyy-mm-dd menjadi dd-mm-yyyy
$tanggal_mulai = date("d-m-Y", strtotime($tanggal_mulai));
$tanggal_selesai = date("d-m-Y", strtotime($tanggal_selesai));
?>

<p class="card-text"><small class="text-muted">Periode: <?php echo $tanggal_mulai; ?> - <?php echo $tanggal_selesai; ?></small></p>
  <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
</div>
<div class="modal-footer">
  <!-- Tambahkan tombol atau aksi lainnya sesuai kebutuhan -->
</div>
</div>
</div>      </div>
    @endif


    @if ($today->gt($endDate) && $today->diffInDays($endDate) <= 7)
          <div class="col-lg-4 portfolio-item filter-app">
      <div class="card-style" data-toggle="modal" data-target="#rewardModal{{ $rewardItem->id }}">

@php
$selesai = \Carbon\Carbon::parse($rewardItem->tanggal_selesai)->endOfDay();
$mulai = \Carbon\Carbon::parse($rewardItem->tanggal_mulai);
$sekarang = \Carbon\Carbon::now();

if ($selesai->isPast()) {
  echo '<span class="badge badge-gray" style="color:white; background-color:gray;">Berakhir</span>';
} elseif ($sekarang >= $mulai && $sekarang <= $selesai) {
  echo '<span class="badge badge-success">Sedang Berjalan</span>';
} elseif ($sekarang < $mulai) {
  echo '<span class="badge badge-info">Akan Datang</span>';
} else {
  echo '<span class="badge badge-danger">Berakhir</span>';
}

@endphp

  <img class="card-img-top mt-3" src="{{asset('img/'.$rewardItem->gambar_reward)}}" alt="{{ $rewardItem->title }}">
  <div class="card-body mt-3">
      <h5 class="card-title">{{ $rewardItem->judul_reward }}</h5>
      <p class="card-text">Kumpulkan poin : {{ $rewardItem->poin_reward }}</p>
<?php
// Mendapatkan tanggal mulai dan tanggal selesai dari $rewardItem
$tanggal_mulai = $rewardItem->tanggal_mulai;
$tanggal_selesai = $rewardItem->tanggal_selesai;

// Mengubah format tanggal dari yyyy-mm-dd menjadi dd-mm-yyyy
$tanggal_mulai = date("d-m-Y", strtotime($tanggal_mulai));
$tanggal_selesai = date("d-m-Y", strtotime($tanggal_selesai));
?>

<p class="card-text"><small class="text-muted">Periode: <?php echo $tanggal_mulai; ?> - <?php echo $tanggal_selesai; ?></small></p>
    </div>
  </div>

</div>

<div class="modal fade" id="rewardModal{{ $rewardItem->id }}" tabindex="-1" role="dialog" aria-labelledby="rewardModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title" id="rewardModalLabel">{{ $rewardItem->judul_reward }}</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="modal-body">
<img src="{{ asset('img/'.$rewardItem->gambar_reward) }}" alt="Gambar Reward" id="gambarmodal">
  <!-- Isi modal dengan informasi dari $rewardItem -->

  <p class="card-text mt-2">Kumpulkan poin : {{ $rewardItem->poin_reward }}</p>
  <p class="card-desc mt-2">{!! nl2br(e($rewardItem->deskripsi_reward)) !!}</p>
  <?php
// Mendapatkan tanggal mulai dan tanggal selesai dari $rewardItem
$tanggal_mulai = $rewardItem->tanggal_mulai;
$tanggal_selesai = $rewardItem->tanggal_selesai;

// Mengubah format tanggal dari yyyy-mm-dd menjadi dd-mm-yyyy
$tanggal_mulai = date("d-m-Y", strtotime($tanggal_mulai));
$tanggal_selesai = date("d-m-Y", strtotime($tanggal_selesai));
?>

<p class="card-text"><small class="text-muted">Periode: <?php echo $tanggal_mulai; ?> - <?php echo $tanggal_selesai; ?></small></p>
  <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
</div>
<div class="modal-footer">
  <!-- Tambahkan tombol atau aksi lainnya sesuai kebutuhan -->
</div>
</div>
</div>      </div>
    @endif

  @endforeach
        
     
        </div>
      </div>


  </section>
</main>

<style>
.card-style {
    margin: 10px;
    padding: 20px;
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #fff; /* Warna latar belakang card */
    transition: transform 0.3s;
}

.card-style h5.card-title {
    font-size: 18px;
    font-weight: bold;
}

.card-img-top {
  border-radius: 10px;
width:100%;
}

.card-style p.card-text {
    font-size: 16px;
}

.card-style small.text-muted {
    font-size: 14px;
    color: #888;
}

.card-style:hover {
    transform: scale(1.02); /* Membesarkan card saat dihover */
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

.portfolio-item {
    margin-bottom: 20px; /* Menambahkan jarak antara card */
}
.badge-danger {
  background-color : red;
}
.badge-success {
  background-color : green;
}
.badge-info {
  background-color : orange;

}

.card-desc {
 color: black;
}

#gambarmodal {
  width:100%;
  height:50%;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
border-radius :5px;
  
} 

/* CSS untuk gambar dalam modal */



</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  // Memfilter kartu saat halaman dimuat, menampilkan yang "Sedang Berjalan"
  filterCards(".filter-card");

  // Memfilter kartu saat filter diubah
  $("#portfolio-flters li").on("click", function() {
    $("#portfolio-flters li").removeClass("filter-active");
    $(this).addClass("filter-active");
    
    var selectedFilter = $(this).data("filter");
    filterCards(selectedFilter);
  });

  function filterCards(filter) {
    // Menampilkan kartu sesuai dengan filter yang dipilih
    $(".portfolio-item").hide();
    $(filter).show();
  }
});
</script>




@endsection
