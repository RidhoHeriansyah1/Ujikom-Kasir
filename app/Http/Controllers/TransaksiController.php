<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Diskon;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function __construct(protected Penjualan $penjualan, protected DetailPenjualan $detailPenjualan)
    {
    }

    public function index()
    {
        $pelanggan = Pelanggan::all();
        $date = Carbon::now();
        $lastId = $this->penjualan->where('status', 'selesai')->latest()->first();
        $newId = $this->penjualan->where('status', 'proses')->latest()->first();
        if ($lastId) {
            $id = $lastId->penjualan_id + 1;
            $data = $this->penjualan->with('detail')->where('penjualan_id', $id)->first();
            $dt = $this->penjualan->where('penjualan_id', $id)->where('pelanggan_id', '!=', null)->first();
            if (isset($dt->detail)) {
                    $diskon = Diskon::where('minimal', '<=', $dt->detail->sum('subtotal'))->orderBy('minimal', 'desc')->first();
                    // dd($dt->detail->sum('subtotal'));
            } else {
                $diskon = 0;
            }
            return view('transaksi.kasir', compact('pelanggan', 'date', 'id', 'data', 'diskon'));
        } elseif ($newId) {
            $id = $newId->penjualan_id;
            $data = $this->penjualan->with('detail')->where('penjualan_id', $id)->first();
            $dt = $this->penjualan->where('pelanggan_id', '!=', null)->where('penjualan_id', $id)->first();
            // dd($data);
            if (isset($dt->detail)) {
                $diskon = Diskon::where('minimal', '<=', $dt->detail->sum('subtotal'))->orderBy('minimal', 'desc')->first();
                // dd($dt->detail->sum('subtotal'));
        } else {
            $diskon = 0;
        }
            return view('transaksi.kasir', compact('pelanggan', 'date', 'id', 'data', 'diskon'));
        } else {
            $id = 1;
            $data = $this->penjualan->with('detail')->where('penjualan_id', $id)->first();
            $dt = $this->penjualan->where('penjualan_id', $id)->where('pelanggan_id', '!=', null)->first();
            if (isset($dt->detail)) {
                $diskon = Diskon::where('minimal', '<=', $dt->detail->sum('subtotal'))->orderBy('minimal', 'desc')->first();
                // dd($dt->detail->sum('subtotal'));
        } else {
            $diskon = 0;
        }
            return view('transaksi.kasir', compact('pelanggan', 'date', 'id', 'data', 'diskon'));
        }
    }

    public function getProduk(Request $request)
    {
        $produk = Produk::where('produk_id', $request->produk_id)->first();

        return response()->json([
            'produk_id' => $produk->produk_id,
            'nama_produk' => $produk->nama_produk,
            'harga' => $produk->harga,
        ]);
    }

    public function keranjang(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required',
            'qty' => 'required|min:1',
            'produk_id' => 'required',
            'subtotal' => 'required',
            'petugas_id' => 'required'
        ]);

        $cekStok = Produk::where('produk_id', $request->produk_id)->first();
        if ($request->qty > $cekStok->stok) {
            return redirect()->back()->with('error', 'Quantiti Melebihi Stok yang tersisa, Stok yang tersisa tinggal ' . $cekStok->stok);
        } else {

            $penjualan = $this->penjualan->where('penjualan_id', $request->penjualan_id)->first();
            $produk = $this->detailPenjualan->where('produk_id', $request->produk_id)->where('penjualan_id', $request->penjualan_id)->first();
            if (!$penjualan) {
                $penjualan = $this->penjualan;
                $penjualan->penjualan_id = $request->penjualan_id;
                if ($request->pelanggan_id == null) {
                    $penjualan->pelanggan_id = null;
                } else {
                    $penjualan->pelanggan_id = $request->pelanggan_id;
                }
                $penjualan->petugas_id = $request->petugas_id;
                $penjualan->status = 'proses';
                $penjualan->save();

                $detailPenjualan = $this->detailPenjualan;
                $detailPenjualan->penjualan_id = $request->penjualan_id;
                $detailPenjualan->produk_id = $request->produk_id;
                $detailPenjualan->jumlah_produk = $request->qty;
                $detailPenjualan->subtotal = $request->subtotal;
            } else {
                if ($produk) {
                    $detailPenjualan = $this->detailPenjualan->findOrFail($produk->detail_id);
                    $detailPenjualan->jumlah_produk = $detailPenjualan->jumlah_produk + $request->qty;
                    $detailPenjualan->subtotal = $detailPenjualan->subtotal + $request->subtotal;

                    $penjualan = $this->penjualan->findOrFail($request->penjualan_id);
                    if ($request->pelanggan_id == null) {
                        $penjualan->pelanggan_id = null;
                    } else {
                        $penjualan->pelanggan_id = $request->pelanggan_id;
                    }
                    $penjualan->save();
                } else {
                    $detailPenjualan = $this->detailPenjualan;
                    $detailPenjualan->penjualan_id = $request->penjualan_id;
                    $detailPenjualan->produk_id = $request->produk_id;
                    $detailPenjualan->jumlah_produk = $request->qty;
                    $detailPenjualan->subtotal = $request->subtotal;


                    $penjualan = $this->penjualan->findOrFail($request->penjualan_id);
                    if ($request->pelanggan_id == null) {
                        $penjualan->pelanggan_id = null;
                    } else {
                        $penjualan->pelanggan_id = $request->pelanggan_id;
                    }
                    $penjualan->save();
                }
            }
            if ($detailPenjualan->save()) {

                return redirect()->back()->with('success', 'Produk berhasil dimasukkan ke keranjang');
            } else {
                return redirect()->back();
            }
        }
    }


    public function pembayaran(Request $request)
    {
        $request->validate([
            'total_pembayaran' => 'required',
            'bayar' => 'required',
            'kembalian' => 'required'
        ]);

        $penjualan = $this->penjualan->findOrFail($request->penjualan_id);
        $penjualan->tanggal_penjualan = Carbon::now();
        $penjualan->total_harga = $request->total_harga;
        $penjualan->total_pembayaran = $request->total_pembayaran;
        $penjualan->bayar = $request->bayar;
        $penjualan->kembalian = $request->kembalian;
        if ($request->potongan_harga == null) {
            $penjualan->potongan_harga = null;
        } else {
            $penjualan->potongan_harga = $request->potongan_harga;
        }
        $penjualan->status = 'selesai';
        $penjualan->save();
        return redirect()->route('transaksi.struk', $request->penjualan_id);
    }

    public function destroy($id)
    {
        $detailPenjualan = $this->detailPenjualan->findOrFail($id);
        $detailPenjualan->delete();
        return redirect()->back()->with('success', 'Produk Berhasil dihapus dikeranjang');
    }

    public function struk($id)
    {
        $data = $this->penjualan->with('detail')->where('penjualan_id', $id)->first();

        return view('laporan.struk', compact('data',));
    }
}
