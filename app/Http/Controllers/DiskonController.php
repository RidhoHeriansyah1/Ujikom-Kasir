<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    public function __construct(protected Diskon $diskon) {}

    public function index()
    {
        $data = $this->diskon->paginate(10);
        return view('diskon.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'minimal' => 'required|min:6',
            'persen' => 'required|min:1|max:3',
        ]);

        $diskon = new $this->diskon;
        $diskon->minimal = $request->minimal;
        $diskon->persen = $request->persen;
        $diskon->save();
        return redirect()->back()->with('success', 'diskon berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'minimal' => 'required|min:6',
            'persen' => 'required|min:1|max:3',
        ]);

        $diskon = $this->diskon->findOrFail($id);
        $diskon->minimal = $request->minimal;
        $diskon->persen = $request->persen;
        $diskon->save();
        return redirect()->back()->with('success', 'diskon berhasil diupdate');
    }

    public function destroy($id)
    {
        $diskon = $this->diskon->findOrFail($id);
        $diskon->delete();
        return redirect()->back()->with('success', 'diskon berhasil dihapus');
    }
}
