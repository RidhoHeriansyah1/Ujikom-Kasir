<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected Pelanggan $pelanggan) {}
    public function index()
    {
        $data = $this->pelanggan->paginate(5);
        return view('pelanggan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required|min:13|max:13'
        ]);
        
        $pelanggan = $this->pelanggan;
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->nomor_telepon = $request->nomor_telepon;
        if($pelanggan->save()){
            return redirect()->route('pelanggan.index')->with('success', 'Data berhasil ditambahkan');
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
        $data = $this->pelanggan->where('pelanggan_id', $id)->first();
        return view('pelanggan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required|min:13|max:13'
        ]);
        
        $pelanggan = $this->pelanggan->findOrFail($id);
        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->nomor_telepon = $request->nomor_telepon;
        if($pelanggan->save()){
            return redirect()->route('pelanggan.index')->with('success', 'Data berhasil diupdate');
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
        $pelanggan = $this->pelanggan->findOrFail($id);
        if($pelanggan->delete()){
            return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil dihapus');
        }else{
            return redirect()->back();
        }
    }
}
