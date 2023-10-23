<!-- myincome.blade.php -->
@extends('layouts.user.app2')

@section('content2')

<main id="main">
<section id="myincome" class="myincome d-flex align-items-center">
        <div class="container">
  
          <div class="row justify-content-between">
            <h3></h3>
            <div class="col-lg-5 d-flex align-items-center justify-content-center income-img">
                
                
                <img src="{{asset ('img/myincomeillus2.png')}}" class="img-myincome" alt="">
            </div>
           

            <div class="col-lg-6 pt-5 pt-lg-0">
 
        <div class="filter-section ">
        <h4 id="income-title">Pendapatan bulan {{ date('F') }} {{ date('Y') }}</h4>
    <form id="income-filter-form">
        <div class="form-group mt-5">
            <label for="bulan">Bulan:</label>
            <input type="month" id="bdaymonth" name="bdaymonth" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary btn-sm mt-3">Terapkan</button>
    </form>
</div>

<div class="card-section mt-3">
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Pendapatan </h5>
            <p class="card-text" id="income-amount">Rp. {{ number_format($totalIncomeThisMonth, 0, ',', '.') }},-</p>
            
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Poin </h5>
            <p class="card-text" id="point-amount">{{ $totalPointsThisMonth }} poin</p>
        </div>
    </div>
</div>
   <!-- Pada bagian ini buatlah filter bulan dan tahun dan dibawah form filter terdapat card untuk memunculkan income-->     
</div>

      </section>
      <!-- End Kalkulator Section -->

</main>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const incomeFilterForm = document.getElementById('income-filter-form');
        const incomeTitle = document.getElementById('income-title');
        const incomeAmount = document.getElementById('income-amount');
        const pointAmount = document.getElementById('point-amount');

        incomeFilterForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const selectedMonth = incomeFilterForm.bdaymonth.value;
            const selectedYear = new Date(selectedMonth).getFullYear();
            const selectedMonthName = new Intl.DateTimeFormat('en-US', { month: 'long' }).format(new Date(selectedMonth));

            // Kirim permintaan ke server dengan data bulan dan tahun yang dipilih
            fetch('/filter-income', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    selectedMonth: selectedMonth,
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Format pendapatan menjadi rupiah
                const formattedIncome = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                }).format(data.totalIncome);

                incomeTitle.textContent = `Pendapatan bulan ${selectedMonthName} ${selectedYear}`;
                incomeAmount.textContent = formattedIncome;
                pointAmount.textContent = `${data.totalPoints} poin`;
            });
        });
    });
</script>

@endsection

<style>

    .card-section .card-title {
        font-size : 13pt;
    }

    .card-section .card-text {
        font-size : 16pt;
        color:#FF9029;
        font-weight: bold;
    }

.filter-section {
    margin-top:50px;
}
    .card-section .card {
        border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #fff; /* Warna latar belakang card */

    }

.myincome .img-myincome {
    width: 135%;
    
}

</style>

