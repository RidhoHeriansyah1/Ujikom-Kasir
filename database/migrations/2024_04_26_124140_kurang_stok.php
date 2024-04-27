<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('CREATE TRIGGER kurang_stok AFTER INSERT ON `detail_penjualans` FOR EACH ROW
                BEGIN
                   UPDATE produks SET produks.stok = produks.stok - new.jumlah_produk WHERE produks.produk_id = new.produk_id;
                END');

        DB::unprepared('CREATE TRIGGER tambah_stok AFTER DELETE ON `detail_penjualans` FOR EACH ROW
                BEGIN
                    UPDATE produks SET produks.stok = produks.stok + old.jumlah_produk WHERE produks.produk_id = old.produk_id;
                END');

        DB::unprepared('CREATE TRIGGER stok_masuk AFTER INSERT ON `stok_masuks` FOR EACH ROW
                 BEGIN
                   UPDATE produks SET produks.stok = produks.stok + new.stok WHERE produks.produk_id = new.produk_id;
                END');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
