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
        Schema::table('detail_insentifs', function (Blueprint $table) {
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Tidak Aktif')-> nullable; // Status file
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_insentifs', function (Blueprint $table) {
            //
        });
    }
};
