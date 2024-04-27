<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'penjualan_id';

    protected $fillable = [
        'tanggal_penjualan',
        'total_harga',
        'total_pembayaran',
        'bayar',
        'kembalian',
        'potongan_harga',
        'pelanggan_id',
        'petugas_id',
        'status'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id')->withTrashed();;
    }
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id', 'id')->withTrashed();;
    }
    public function detail()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id', 'penjualan_id');
    }

}
