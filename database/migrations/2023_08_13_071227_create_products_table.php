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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->unsignedBigInteger('role_id');
            $table->integer('poin_produk');
            $table->string('gambar_produk');
            $table->string('deskripsi_produk');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::table('products', function($table) {
            $table->foreign('role_id')->references('id')->on('user_roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
