<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'penjualan_id',
        'produk_id',
        'jumlah_produk',
        'subtotal',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id', 'penjualan_id')->withTrashed();;
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id')->withTrashed();
    }
}
