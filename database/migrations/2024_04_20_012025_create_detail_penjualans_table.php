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
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id('detail_id');
            $table->bigInteger('penjualan_id',)->unsigned();
            $table->bigInteger('produk_id',)->unsigned();
            $table->integer('jumlah_produk');
            $table->decimal('subtotal', 10,2);
            $table->timestamps();

            $table->foreign('penjualan_id')->references('penjualan_id')->on('penjualans');
            $table->foreign('produk_id')->references('produk_id')->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualans');
    }
};
