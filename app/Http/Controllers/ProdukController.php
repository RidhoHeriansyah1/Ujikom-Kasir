<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected Produk $produk) {}

    public function index()
    {
        $data = $this->produk->paginate(10);
        return view('produk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required|integer|min:1'
        ]);

        $produk = $this->produk;
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        if($produk->save()){
            return redirect()->route('produk.index')->with('success', 'Data berhasil ditambahkan');
        }
        else{
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->produk->where('produk_id', $id)->first();
        return view('produk.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required|integer|min:1'
        ]);

        $produk = $this->produk->findOrFail($id);
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        if($produk->save()){
            return redirect()->route('produk.index')->with('success', 'Data berhasil diupdate');
        }
        else{
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = $this->produk->findOrFail($id);
        if($produk->delete()){
            return redirect()->route('produk.index')->with('success', 'Data Berhasil dihapus');
        }else{
            return redirect()->back();
        }
    }
}
