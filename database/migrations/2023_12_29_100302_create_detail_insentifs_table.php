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
        Schema::create('detail_insentifs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skema_id');
            $table->integer('insentif')->nullable();
            $table->integer('min_qty')->nullable;
            $table->integer('max_qty')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_insentifs');
    }
};
