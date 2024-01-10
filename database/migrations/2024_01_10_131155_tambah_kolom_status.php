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
            $table->boolean('status')->default(false)->nullable(); // default ke false

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
