@extends('layouts.user.app2')

@section('content2')

<!-- ======= Income Section ======= -->
<section id="income" class="income">
    <div class="container">

        <div class="row justify-content-between">
            <div class="col-lg-5 d-flex align-items-center justify-content-center income-img">
                <img src="{{ asset('img/income-illus.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-5 pt-lg-0">

                <div class="button-income">
                    <h2>Pilih pendapatan yang ingin kamu capai</h2>
                    <style>
                        .card {
                            margin-bottom: 20px;
                            margin-right: 30px;
                            border: 2px solid #f2f2f2;
                            border-radius: 10px;
                            transition: transform 0.2s;
                        }

                        .card:hover {
                            transform: scale(1.05);
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        }

                        .card-title {
                            color: #333;
                        }

                        .btn-link {
                            color: #007bff;
                        }
                        .pagination-container {
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            margin-top: 20px;
                        }
                        
                    </style>
                    <div class="row">
                        @foreach ($paket as $data)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $data->judul_paket }}</h5>
                                        <a href="{{ route('tampilincome', $data->id) }}" class="btn btn-link" style="color:#ff9029" role="button" data-bs-toggle="button">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-4 pagination-container">
                        {{ $paket->links() }}
                    </div>
                    </div>
                    <!-- Pagination links -->
                   
                </div>
            </div>
        </div>
    </div>
</section><!-- End Income Section -->
@endsection
