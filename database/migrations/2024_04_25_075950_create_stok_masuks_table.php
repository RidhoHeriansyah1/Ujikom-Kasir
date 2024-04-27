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
        Schema::create('stok_masuks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('produk_id')->unsigned()->nullable();
            $table->integer('stok');
            $table->bigInteger('diinput')->unsigned()->nullable();
            $table->date('tanggal');
            $table->softDeletes();

            $table->foreign('produk_id')->references('produk_id')->on('produks');
            $table->foreign('diinput')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_masuks');
    }
};
