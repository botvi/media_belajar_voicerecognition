<?php

namespace App\Http\Controllers\superadmin;

use App\Models\BelajarMembaca;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class BelajarMembacaController extends Controller
{
    public function index()
    {
        $belajarMembaca = BelajarMembaca::all();
        return view('pageadmin.belajar-membaca.index', compact('belajarMembaca'));
    }

    public function create()
    {
        return view('pageadmin.belajar-membaca.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'konten' => 'required|array|min:1',
            'konten.*' => 'required|string',
        ]);

        BelajarMembaca::create([
            'konten' => $request->konten, // Laravel akan otomatis menyimpan sebagai array jika di-cast di model
        ]);

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('belajar-membaca.index');
    }


    public function edit(BelajarMembaca $belajarMembaca)
    {
        return view('pageadmin.belajar-membaca.edit', compact('belajarMembaca'));
    }

    public function update(Request $request, BelajarMembaca $belajarMembaca)
    {
        $request->validate([
            'konten' => 'required|array',
        ]);

        $belajarMembaca->update([
            'konten' => $request->konten,
        ]);

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->route('belajar-membaca.index');
    }

    public function destroy(BelajarMembaca $belajarMembaca)
    {
        $belajarMembaca->delete();
        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->route('belajar-membaca.index');
    }
}
