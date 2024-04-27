<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StokMasuk extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'produk_id',
        'stok',
        'diinput',
        'tanggal'
    ];

    public $timestamps = false;

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id')->withTrashed();;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'diinput', 'id')->withTrashed();;
    }
}
