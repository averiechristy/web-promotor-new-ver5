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
            <li data-filter="*" class="filter-active">Semua</li>
            <li data-filter=".filter-app">Tidak Aktif</li>
            <li data-filter=".filter-card">Sedang Berjalan</li>
            <li data-filter=".filter-web">Akan Datang</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container" data-aos-delay="200">
      <div class="col-lg-4 col-md-6 portfolio-item filter-app">
        @foreach ($reward as $rewardItem)
        @if ($rewardItem->status === 'Tidak Aktif')
        
          <div class="card-deck " >
            <div class="card-style" data-toggle="modal" data-target="#rewardModal{{ $rewardItem->id }}">
            <span class="badge badge-danger">{{ $rewardItem->status }}</span> <!-- Badge status -->
              <img class="card-img-top mt-3" src="{{asset('img/'.$rewardItem->gambar_reward)}}" alt="{{ $rewardItem->title }}">
              <div class="card-body mt-3">
                <h5 class="card-title">{{ $rewardItem->judul_reward }}</h5>
                <p class="card-text">Kumpulkan poin : {{ $rewardItem->poin_reward }}</p>
                <p class="card-text"><small class="text-muted">Periode : {{$rewardItem->tanggal_mulai}} - {{$rewardItem->tanggal_selesai}}</small></p>
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
                <p class="card-text"><small class="text-muted">Periode : {{$rewardItem->tanggal_mulai}} - {{$rewardItem->tanggal_selesai}}</small></p>
            <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
          </div>
          <div class="modal-footer">
            <!-- Tambahkan tombol atau aksi lainnya sesuai kebutuhan -->
          </div>
        </div>
      </div>
    </div>
  @endif
        @endforeach
      </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
        @foreach ($reward as $rewardItem)
        @if ($rewardItem->status === 'Sedang berjalan')
          <div class="card-deck">
            <div class="card-style" data-toggle="modal" data-target="#rewardModal{{ $rewardItem->id }}">
            <span class="badge badge-success">{{ $rewardItem->status }}</span> <!-- Badge status -->

              <img class="card-img-top mt-3" src="{{asset('img/'.$rewardItem->gambar_reward)}}" alt="{{ $rewardItem->title }}">
              <div class="card-body mt-3">
                <h5 class="card-title">{{ $rewardItem->judul_reward }}</h5>
                <p class="card-text">Kumpulkan poin : {{ $rewardItem->poin_reward }}</p>
                <p class="card-text"><small class="text-muted">Periode : {{$rewardItem->tanggal_mulai}} - {{$rewardItem->tanggal_selesai}}</small></p>
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
                <p class="card-text"><small class="text-muted">Periode : {{$rewardItem->tanggal_mulai}} - {{$rewardItem->tanggal_selesai}}</small></p>
            <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
          </div>
          <div class="modal-footer">
            <!-- Tambahkan tombol atau aksi lainnya sesuai kebutuhan -->
          </div>
        </div>
      </div>
    </div>
  @endif
  @endforeach
        </div>
        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
@foreach ($reward as $rewardItem)
        @if ($rewardItem->status === 'Akan datang')
          <div class="card-deck">
            <div class="card-style" data-toggle="modal" data-target="#rewardModal{{ $rewardItem->id }}">
            <span class="badge badge-info">{{ $rewardItem->status }}</span> <!-- Badge status -->

              <img class="card-img-top mt-3" src="{{asset('img/'.$rewardItem->gambar_reward)}}" alt="{{ $rewardItem->title }}">
              <div class="card-body mt-3">
                <h5 class="card-title">{{ $rewardItem->judul_reward }}</h5>
                <p class="card-text">Kumpulkan poin : {{ $rewardItem->poin_reward }}</p>
                <p class="card-text"><small class="text-muted">Periode : {{$rewardItem->tanggal_mulai}} - {{$rewardItem->tanggal_selesai}}</small></p>
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
                <p class="card-text"><small class="text-muted">Periode : {{$rewardItem->tanggal_mulai}} - {{$rewardItem->tanggal_selesai}}</small></p>
            <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
          </div>
          <div class="modal-footer">
            <!-- Tambahkan tombol atau aksi lainnya sesuai kebutuhan -->
          </div>
        </div>
      </div>
    </div>
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
  // Saat halaman dimuat, tampilkan semua proyek (filter aktif)
  $(".portfolio-item").show();

  // Ketika salah satu filter diklik
  $("#portfolio-flters li").click(function() {
    // Menghapus kelas 'filter-active' dari semua elemen filter
    $("#portfolio-flters li").removeClass('filter-active');
    // Menambahkan kelas 'filter-active' ke elemen filter yang diklik
    $(this).addClass('filter-active');

    // Mendapatkan nilai data-filter dari filter yang diklik
    var filterValue = $(this).attr('data-filter');

    // Menyembunyikan semua proyek
    $(".portfolio-item").hide();

    // Menampilkan proyek yang sesuai dengan filter yang dipilih
    if (filterValue == "*") {
      $(".portfolio-item").show();
    } else {
      $(".portfolio-item" + filterValue).show();
    }
  });

  
 
});

</script>



@endsection
