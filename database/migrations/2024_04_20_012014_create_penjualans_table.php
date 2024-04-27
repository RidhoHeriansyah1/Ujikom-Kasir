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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id('penjualan_id');
            $table->date('tanggal_penjualan',)->nullable();
            $table->decimal('total_harga', 10,2)->nullable();
            $table->decimal('total_pembayaran', 10,2)->nullable();
            $table->decimal('bayar', 10,2)->nullable();
            $table->decimal('kembalian', 10,2)->nullable();
            $table->decimal('potongan_harga', 10,2)->nullable();
            $table->bigInteger('pelanggan_id')->unsigned()->nullable();
            $table->bigInteger('petugas_id')->unsigned()->nullable();
            $table->string('status', 10);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('pelanggan_id')->references('pelanggan_id')->on('pelanggans');
            $table->foreign('petugas_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
