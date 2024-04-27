<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelanggan extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'pelanggan_id';

    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'nomor_telepon',
    ];
}
