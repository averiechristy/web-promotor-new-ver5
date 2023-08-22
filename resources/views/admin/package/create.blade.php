@extends('layouts.admin.app')

@section('content')
 

<div class="container">
                        <div class="row">
                            <div class="col-8 offset-2">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        Insert a new Package Income
                                    </div>
                                    <div class="card-body">
                                        
                                       <form action="{{route('admin.package.simpan')}}" method="post">
                                       @csrf
                                            
                                            <div class="form-group mb-4 " id="koderole">
                                            <label for="role">Select Role:</label>
    <select name = "role_id" id="role" class="form-control">
    <option value="" disabled selected>Select a role</option> <!-- Hidden option -->
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

                                               
                                            </div>
        

                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Judul Paket</label>
                                                <input name="judul_paket" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required />
                                               
                                            </div>
                                    
                                            <div class="form-group mb-4">
                                                <label for="" class="form-label">Deskripsi Paket</label>
                                                <textarea name="deskripsi_paket" type="text" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"  style="border-color: #01004C;" value="" required > </textarea>
                                                <!-- @if ($errors->has('code'))
                                                    <p class="text-danger">{{$errors->first('code')}}</p>
                                                @endif -->
                                            </div>
                                            

                                           
                                            <div class="form-group mb-4">
                                            <div id="product-container">
        <div class="product-item">
            <label for="product">Select Product:</label>
            <select name="data_produk[${counter}][nama_produk]" class="product-select form-control">
                <!-- JavaScript will populate this based on selected role -->
                <option value="" disabled selected>Select a product</option> <!-- Hidden option -->
            </select>
            
                       
            <label for="quantity">Quantity:</label>
            <input type="number" name="data_produk[${counter}][qty_produk]" class="quantity-input form-control">

                   
    <div class="form-group mb-4">
            <button type="button " class="remove-product btn btn-danger  btn-sm mt-2 mb-2" style="float: right">Remove</button> <!-- Tombol Remove -->
            </div>
        </div>
    </div>
    </div>
            
    <div class="form-group mb-4">
    <button type="button" class="add-product btn btn-success">Add More Product</button>

    </div>                                       

                                               

                                            

    

                                            <div class="form-group mb-4">
                                                <button type="submit" class="btn " style="background-color: #01004C; color: white;">Submit</button>
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
                        productsSelect.append('<option value="'+ produk.nama_produk +  '">' + produk.kode_produk + " - " + produk.nama_produk + '</option>');                  


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



productSelect.attr('name', `data_produk[${counter}][nama_produk]`);
            quantityInput.attr('name', `data_produk[${counter}][qty_produk]`);

            
             // Reset nilai input fields dan select box
    productSelect.val('');
    quantityInput.val('');

    // Hapus elemen label dan input fields sebelumnya
    productItem.find('label').remove();
    productItem.find('.product-select').remove();
    productItem.find('.quantity-input').remove();
    productItem.find('.remove-product').remove();

            productItem.append('<label for="quantity">Product:</label>');
            productItem.append(productSelect);

            productItem.append('<div style="margin-top: 10px;"></div>');

            productItem.append('<label for="quantity">Quantity:</label>');
            productItem.append(quantityInput);
           
            productItem.append( removeProduct);


            productContainer.append(productItem);
            productItem.append('<div style="margin-top: 40px;"></div>');

            counter++;
        });

        $(document).on('click', '.remove-product', function() {
            var productContainer = $('#product-container');
            
            if (productContainer.children('.product-item').length > 1) {
                $(this).closest('.product-item').remove();
            } else {
                alert("You cannot remove the first product.");
            }
        });
    });
</script>
@endsection