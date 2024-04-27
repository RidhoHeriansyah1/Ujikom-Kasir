<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\StokMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{

    public function __construct(protected StokMasuk $stokMasuk, protected Penjualan $penjualan) {}
    public function tambahStok(Request $request)
    {
        $request->validate([
            'stok' => 'required|min:1'
        ]);

        $stokMasuk = new $this->stokMasuk;
        $stokMasuk->produk_id = $request->produk_id;
        $stokMasuk->stok = $request->stok;
        $stokMasuk->diinput = auth()->user()->id;
        $stokMasuk->tanggal = Carbon::now();
        if($stokMasuk->save()){
            return redirect()->back()->with('success', 'Stok Berhasil ditambahkan');
        }
    }

    public function stokMasuk()
    {
        $data = $this->stokMasuk->all();
        return view('laporan.stok-masuk', compact('data'));
    }

    public function search(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $data = $this->stokMasuk->whereBetween('tanggal', [$dari, $sampai])->get();
        return view('laporan.stok-masuk', compact('data'));
    }

    public function stokKeluar()
    {
        $data = $this->penjualan->with('detail')->where('status', 'selesai')->get();
        return view('laporan.stok-keluar', compact('data'));
    }

    public function stokKeluarSearch(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $data = $this->penjualan->whereBetween('tanggal_penjualan', [$dari, $sampai])->where('status', 'selesai')->with('detail')->get();
        return view('laporan.stok-keluar', compact('data'));
    }

    public function laporanTransaksi()
    {
        $data = $this->penjualan->with('detail')->where('status', 'selesai')->get();
        return view('laporan.laporan-transaksi', compact('data'));
    }

    public function transaksiSearch(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $data = $this->penjualan->whereBetween('tanggal_penjualan', [$dari, $sampai])->where('status', 'selesai')->with('detail')->get();
        return view('laporan.laporan-transaksi', compact('data'));
    }

}
