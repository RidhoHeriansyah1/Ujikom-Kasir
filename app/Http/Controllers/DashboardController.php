<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\StokMasuk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $produk = Produk::count();
        $pelanggan = Pelanggan::count();
        $penjualan = Penjualan::where('status', 'selesai');
        $transaksi = $penjualan->count();
        $stokMasuk = StokMasuk::sum('stok');
        
        
        return view('dashboard.index', compact('produk', 'pelanggan', 'transaksi', 'stokMasuk'));
    }
}
