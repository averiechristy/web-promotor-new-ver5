<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('package_incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            // $table->unsignedBigInteger('produk_id');
            $table->string('judul_paket');
            $table->string('deskripsi_paket');
            $table->json('produk');
            // $table->string('nama_produk');
            // $table->string('qty_produk');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('package_incomes', function($table) {
            // $table->foreign('produk_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('role_id')->references('id')->on('user_roles')->onDelete('cascade')->onUpdate('cascade');
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_incomes');
    }
};
