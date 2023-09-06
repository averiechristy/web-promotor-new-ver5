@extends('layouts.admin.app')

@section('content')
 

<div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Edit Paket Pendapatan
                                    </div>
                                    <div class="card-body">
                                        
     <form id="form-id" action="/updatepackage/{{$package->id}}" method="post">
     @csrf
                                            
     <div class="form-group mb-4" id="koderole">
    <label for="role">Kode Role</label>
    <select name="role_id" id="role" class="form-control {{$errors->has('role_id') ? 'is-invalid' : ''}}" style="border-color: #01004C;">
        <option value="" disabled>Pilih Kode Role</option> <!-- Hidden option -->
        
        @php
        $selectedRoleId = old('role_id', $package->role_id); // Mengambil nilai 'role_id' dari request old atau menggunakan nilai default dari $package
        $uniqueRoles = $produk->unique('Role.id'); // Memastikan pilihan unik berdasarkan id Role
        @endphp

        @foreach ($uniqueRoles as $item)
            <option value="{{ $item->Role->id }}" @if ($item->Role->id == $selectedRoleId) selected @endif>
                {{ $item->Role->kode_role }} - {{ $item->Role->jenis_role }}
            </option>
        @endforeach
    </select>

    @if ($errors->has('role_id'))
        <p class="text-danger">{{$errors->first('role_id')}}</p>
    @endif
</div>
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Judul Paket</label>
                                                <input name="judul_paket" type="text" class="form-control {{$errors->has('judul_paket') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="{{ old('judul_paket',$package->judul_paket) }}" />
                                                @if ($errors->has('judul_paket'))
                                                    <p class="text-danger">{{$errors->first('judul_paket')}}</p>
                                                @endif
                                            </div>
                                    
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Deskripsi Paket</label>
                                                <textarea name="deskripsi_paket" type="text" class="form-control {{$errors->has('deskripsi_paket') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="">{{ old('deskripsi_paket',$package->deskripsi_paket) }}</textarea>
                                                @if ($errors->has('deskripsi_paket'))
                                                    <p class="text-danger">{{$errors->first('deskripsi_paket')}}</p>
                                                @endif
                                            </div>

                                            <div class="form-group mb-4">
                                            <div id="product-container">
                                                
    @foreach ($nama as $detailData)
    <div class="product-item">
        <label for="product">Pilih Produk</label>
        <select name="produk[]" class="product-select form-control {{$errors->has('produk') ? 'is-invalid' : ''}}"  style="border-color: #01004C;">
            @foreach ($produk as $product)
                @if ($product->role_id == $selectedRoleId)
                <option value="{{ $product->id }}" {{ $detailData->produk_id == $product->id ? 'selected' : '' }}>
                        {{ $product->kode_produk }} - {{ $product->nama_produk }}
                    </option>
                @endif
            @endforeach
        </select>
        @if ($errors->has('produk'))

                                                    <p class="text-danger">{{$errors->first('produk')}}</p>
                                                @endif

                                                <label for="quantity">Quantity</label>
<input type="number" name="qty_produk[]" class="quantity-input form-control {{$errors->has('qty_produk') ? 'is-invalid' : ''}}" style="border-color: #01004C;" value="{{ intval(old('qty_produk', $detailData->qty_produk)) }}" required>

@if ($errors->has('qty_produk'))
    <p class="text-danger">{{$errors->first('qty_produk')}}</p>
@endif

        <div class="form-group mb-4">
            <button type="button" class="remove-product btn btn-danger btn-sm mt-2 mb-2" style="float: right">Hapus</button>
        </div>
    </div>
@endforeach


                   
    
        </div>
    </div>
    </div>
            
    <div class="form-group mb-4 ml-3">
    <button type="button" class="add-product btn btn-success">Tambah Produk</button>

    </div>                                       

                                            <div class="form-group mb-4  ml-3">
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
        var counter = 0; // Set counter sesuai dengan jumlah produk yang ada


        
        $('#role').change(function() {
            var roleId = $(this).val();
            $.ajax({
                url: '/getProduct/' + roleId,
                type: 'GET',
                success: function(data) {
                    var productsSelect = $('.product-select');
                    
                    productsSelect.empty();
                    $.each(data, function(key, produk) {
                        productsSelect.append('<option value="'+ produk.id +  '">' + produk.kode_produk + " - " + produk.nama_produk + '</option>');                  

                    });
                }
            });
        });

        $('.add-product').click(function() {
            var productContainer = $('#product-container');
            var productItem = $('<div class="product-item">');
            
            var existingSelect = $('.product-select').eq(0);
            var productSelect = existingSelect.clone();
            
            var existingQuantityInput = $('.quantity-input').eq(0);
            var quantityInput = existingQuantityInput.clone();

            var existingQuantityInput = $('.remove-product').eq(0);
            var removeProduct = existingQuantityInput.clone();

            var counterElement = $('<span class="counter">' + (counter + 1) + '</span>');

            productSelect.attr('name', `produk[]`);
            quantityInput.attr('name', `qty_produk[]`);

            
             // Reset nilai input fields dan select box
            productSelect.val('');
            quantityInput.val('');

            // Hapus elemen label dan input fields sebelumnya
            productItem.find('label').remove();
            productItem.find('.product-select').remove();
            productItem.find('.quantity-input').remove();
            productItem.find('.remove-product').remove();

            productItem.append('<label for="quantity">Pilih Produk</label>');
            productItem.append(productSelect);

            productItem.append('<div style="margin-top: 10px;"></div>');

            productItem.append('<label for="quantity">Quantity</label>');
            productItem.append(quantityInput);
           
            productItem.append( removeProduct);


            productContainer.append(productItem);
            productItem.append('<div style="margin-top: 40px;"></div>');

            productSelect.attr('data-selected', productSelect.val());


            counter++;
            $('.product-select').each(function() {
        var selectedOption = $(this).find('option:selected');
        $(this).attr('data-selected', selectedOption.val());
    });
        });

        $(document).on('click', '.remove-product', function() {
            var productContainer = $('#product-container');
            
            if (productContainer.children('.product-item').length > 1) {
                $(this).closest('.product-item').remove();
            } else {
                alert("Anda tidak dapat menghapus produk pertama.");
            }
        });
    

    $('#form-id').submit(function(event) {
        var valid = true;
        var selectedProducts = []; // Array untuk menyimpan produk yang sudah dipilih
        
        $('.product-item').each(function(index) {
            var productSelect = $(this).find('.product-select');
            var quantityInput = $(this).find('.quantity-input');

            if (productSelect.val() === '' || quantityInput.val() === '') {
                valid = false;
                return false; // Keluar dari loop jika salah satu tidak valid
            }

            var selectedProductId = productSelect.val();
            if (selectedProducts.includes(selectedProductId)) {
                valid = false;
                alert("Produk yang sama tidak boleh dipilih lebih dari satu kali.");
                return false; // Keluar dari loop jika produk sudah dipilih sebelumnya
            } else {
                selectedProducts.push(selectedProductId);
            }
        });

        if (!valid) {
            event.preventDefault(); // Mencegah form disubmit jika ada input yang tidak valid
            // alert("Silahkan masukan produk dan quantity nya.");
        }
    });
});
    
</script>
@endsection