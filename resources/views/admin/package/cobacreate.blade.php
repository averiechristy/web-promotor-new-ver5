@extends('layouts.admin.app')

@section('content')
<!-- resources/views/create_form.blade.php -->

<form action="" method="POST">
    @csrf

    <label for="role">Select Role:</label>
    <select name="role" id="role">
        <!-- Render options from database -->
        @php
        $selectedRoleIds = []; // Array untuk menyimpan role_id yang telah ditambahkan
        @endphp

        @foreach ($produk as $item)
            @if (!in_array($item->role_id, $selectedRoleIds))
                @php
                $selectedRoleIds[] = $item->role_id;
                @endphp
                <option value="{{ $item->role_id }}">{{ $item->Role->kode_role }} - {{ $item->Role->jenis_role }}</option>
            @endif
        @endforeach
    </select>

    <div id="product-container">
        <div class="product-item">
            <label for="product">Select Product:</label>
            <select name="product[]" class="product-select">
                <!-- JavaScript will populate this based on selected role -->
            </select>
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity[]" class="quantity-input">
        </div>
    </div>

    <button type="button" class="add-product">Add More Product</button>

    <button type="submit">Submit</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        productsSelect.append('<option value="' + produk.nama_produk + '">' + produk.kode_produk + " - " + produk.nama_produk + '</option>');
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

            productItem.append(productSelect);
            productItem.append('<label for="quantity">Quantity:</label>');
            productItem.append(quantityInput);

            productContainer.append(productItem);
        });
    });
</script>
@endsection
