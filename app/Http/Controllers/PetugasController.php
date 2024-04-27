<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(protected User $user) {}
    public function index()
    {
        $data = $this->user->where('role_id', 2)->paginate(5);
        return view('petugas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|regex:/[0-9]/'
        ]);

        $pelanggan = $this->user;
        $pelanggan->name = $request->name;
        $pelanggan->email = $request->email;
        $pelanggan->password = $request->password;
        $pelanggan->role_id = $request->role_id;
        if($pelanggan->save()){
            return redirect()->route('petugas.index')->with('success', 'Data berhasil ditambahkan');
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
        $data = $this->user->where('id', $id)->first();
        return view('petugas.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $pelanggan = $this->user->findOrFail($id);
        $pelanggan->name = $request->name;
        $pelanggan->email = $request->email;
        if($request->password != null){
            $pelanggan->password = Hash::make($request->password);
        }
        if($pelanggan->save()){
            return redirect()->route('petugas.index')->with('success', 'Data berhasil diupdate');
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
        $pelanggan = $this->user->findOrFail($id);
        if($pelanggan->delete()){
            return redirect()->route('petugas.index')->with('success', 'Data Berhasil dihapus');
        }else{
            return redirect()->back();
        }
    }
}
