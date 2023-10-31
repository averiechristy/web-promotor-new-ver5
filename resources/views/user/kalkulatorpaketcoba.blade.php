@extends('layouts.user.app2')

@section('content2')

<main id="main">
    <section id="kalkulatorpaket" class="count d-flex align-items-center">
        <div class="container">
            <h2>Kalkulator Penjumlahan Cicilan</h2>
            <form id="cicilan-form">
                <div id="input-fields">
                    <div class="input-field">
                        <label for="nama_barang">Nama Barang:</label>
                        <select name="nama_barang[]">
                            <option value="motor">Motor</option>
                            <option value="mobil">Mobil</option>
                            <option value="mobil">Rumah</option>
                            <option value="other">Other</option>
                        </select>
                        <input type="text" name="nama_barang_other[]" style="display:none;" placeholder="Masukkan Nama Barang Lainnya">
                        <label for="cicilan">Cicilan:</label>
                        <input type="number" name="cicilan[]">
                    </div>
                </div>
                <button type="button" id="add-field">Tambah Barang</button>
                <br><br>
                <button type="submit">Hitung Cicilan</button>
            </form>
            <div id="total-cicilan">
                Total Cicilan: <span id="result">0</span>
            </div>

            <div id="form-sales-skills" style="display: none;">
                <h2>Kamu lebih jago penjualan apa</h2>
                <form id="sales-skills-form">
                   
                @foreach ($produk as $produk)
    <div class="col-auto">
        <label for="inputPassword6" class="col-form-label">{{ $produk->nama_produk }}</label>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <input type="number" class="form-control" style="width: 300px" name="product_persen[{{ $produk->id }}]" min="0" id="input-expression_{{ $produk->id }}" value="{{ isset($_SESSION['product_persen'][$produk->id]) ? $_SESSION['product_persen'][$produk->id] : old('product_persen.' . $produk->id) }}">
        </div>
        <div class="col-auto">
            <span id="passwordHelpInline_{{ $produk->id }}" class="form-text">
                {{ $produk->poin_produk }} poin
            </span>
        </div>
    </div>
@endforeach

                    <button type="submit">Simpan</button>

                    <div id="resultContainer"></div>


                    
                </form>


            </div>
        </div>
    </section>
</main>

@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Tangani perubahan pada select box
    const selectInputs = document.querySelectorAll("select[name='nama_barang[]']");
    const otherInputFields = document.querySelectorAll("input[name='nama_barang_other[]']");
    
    selectInputs.forEach((select, index) => {
        select.addEventListener("change", function () {
            if (select.value === "other") {
                otherInputFields[index].style.display = "block";
            } else {
                otherInputFields[index].style.display = "none";
                otherInputFields[index].value = "";
            }
        });
    });
    
    // Tambahkan input field dinamis
    const addButton = document.getElementById("add-field");
    const inputFieldsContainer = document.getElementById("input-fields");
    const inputFieldTemplate = document.querySelector(".input-field").cloneNode(true);
    
    addButton.addEventListener("click", function () {
        const newInputField = inputFieldTemplate.cloneNode(true);
        inputFieldsContainer.appendChild(newInputField);
        
        // Perbarui kembali NodeList untuk input dan select yang baru ditambahkan
        const selectInputs = document.querySelectorAll("select[name='nama_barang[]']");
        const otherInputFields = document.querySelectorAll("input[name='nama_barang_other[]']");
        
        selectInputs.forEach((select, index) => {
            select.addEventListener("change", function () {
                if (select.value === "other") {
                    otherInputFields[index].style.display = "block";
                } else {
                    otherInputFields[index].style.display = "none";
                    otherInputFields[index].value = "";
                }
            });
        });
    });
    
    // Hitung total cicilan
    const form = document.getElementById("cicilan-form");
    const salesSkillsForm = document.getElementById("form-sales-skills")
    const resultSpan = document.getElementById("result");
    
     form.addEventListener("submit", function (e) {
        e.preventDefault();
        const cicilanInputs = document.querySelectorAll("input[name='cicilan[]']");
        let totalCicilan = 0;

        cicilanInputs.forEach((input) => {
            if (!isNaN(input.value)) {
                totalCicilan += parseInt(input.value);
            }
        });

        // Tampilkan pesan popup
        alert("Kita simpan Rp. 3.000.000 untuk kebutuhan harianmu ya.");

        // Tambahkan 3 juta ke total cicilan
        totalCicilan += 3000000;

        // Konversi total cicilan ke dalam poin
        let totalPoin = 0;

        if (totalCicilan <= 3600000) {
            // Jika total cicilan <= 3,600,000, maka per 1 poin nilainya 50,000
            totalPoin = Math.ceil(totalCicilan / 50000);
        } else if (totalCicilan <= 6000000) {
            // Jika total cicilan <= 6,000,000, maka 72 poin nilainya 3,600,000
            totalPoin = 72 + Math.ceil((totalCicilan - 3600000) / 40000);
        } else {
            // Jika total cicilan > 6,000,000, maka 120 poin nilainya 6,000,000
            totalPoin = 120 + Math.ceil((totalCicilan - 6000000) / 40000);
        }

        resultSpan.textContent = `Total Cicilan: ${totalCicilan} | Total Poin: ${totalPoin}`;
        salesSkillsForm.style.display = "block"; 
        
        salesSkillsForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // Mengumpulkan semua nilai persentase dari input
    const persentaseInputs = document.querySelectorAll("input[name^='product_persen[']");
    
    // Menghitung poin untuk masing-masing produk
    const jumlahProduk = {};
    
    persentaseInputs.forEach((input) => {
        const id = input.name.match(/\[(\d+)\]/)[1];
        const passwordHelpInline = document.getElementById("passwordHelpInline_" + id);
        const poinProdukText = passwordHelpInline.textContent;
        
        // Memisahkan nilai poin_produk dari teks
        const poinProduk = poinProdukText.trim().split(" ")[0];
        
        const persentase = parseFloat(input.value);
        const poin = Math.round((persentase / 100) * totalPoin / poinProduk);
        jumlahProduk[id] = poin;
    });

    // Lakukan sesuatu dengan data jumlahProduk, misalnya, tampilkan atau simpan
    const resultContainer = document.getElementById("resultContainer");
resultContainer.innerHTML = "Jumlah Produk:";
for (const id in jumlahProduk) {
    resultContainer.innerHTML += `<p>Produk ${id}: ${jumlahProduk[id]}</p>`;
}
});

        
    });

});
</script>


