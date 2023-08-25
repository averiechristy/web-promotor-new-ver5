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
        Schema::table('user_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('akses_id');


        });

        Schema::table('user_roles', function($table) {
            // $table->foreign('produk_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('akses_id')->references('id')->on('akses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_roles', function (Blueprint $table) {
            //
        });
    }
};
