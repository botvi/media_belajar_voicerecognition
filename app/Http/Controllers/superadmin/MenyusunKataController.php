<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\MenyusunKata;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class MenyusunKataController extends Controller
{
   public function index()
   {
      $menyusunKata = MenyusunKata::all();
      return view('pageadmin.menyusun_kata.index', compact('menyusunKata'));
   }

   public function create()
   {
      return view('pageadmin.menyusun_kata.create');
   }

   public function store(Request $request)
   {
      $request->validate([
         'soal' => 'required',
         'jawaban' => 'required',
         'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
      ]);

      $gambar = $request->file('gambar');
      $namaGambar = time().'.'.$gambar->getClientOriginalExtension();
      $gambar->move(public_path('gambar'), $namaGambar);

      MenyusunKata::create([
         'soal' => $request->soal,
         'jawaban' => $request->jawaban,
         'gambar' => $namaGambar
      ]);

      Alert::success('Success', 'Data berhasil disimpan');
      return redirect()->route('menyusun-kata.index');
   }

   public function edit($id)
   {
      $menyusunKata = MenyusunKata::find($id);
      return view('pageadmin.menyusun_kata.edit', compact('menyusunKata'));
   }

   public function update(Request $request, $id)
   {
      $menyusunKata = MenyusunKata::find($id);
      $request->validate([
         'soal' => 'required',
         'jawaban' => 'required',
         'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
      ]);

      if($request->hasFile('gambar')) {
         // Hapus gambar lama
         File::delete(public_path('gambar/'.$menyusunKata->gambar));
         
         // Upload gambar baru
         $gambar = $request->file('gambar');
         $namaGambar = time().'.'.$gambar->getClientOriginalExtension();
         $gambar->move(public_path('gambar'), $namaGambar);
         
         $menyusunKata->update([
            'soal' => $request->soal,
            'jawaban' => $request->jawaban,
            'gambar' => $namaGambar
         ]);
      } else {
         $menyusunKata->update([
            'soal' => $request->soal,
            'jawaban' => $request->jawaban
         ]);
      }

      Alert::success('Success', 'Data berhasil diubah');
      return redirect()->route('menyusun-kata.index');
   }

   public function destroy($id)
   {
      $menyusunKata = MenyusunKata::find($id);
      // Hapus file gambar
      File::delete(public_path('gambar/'.$menyusunKata->gambar));
      $menyusunKata->delete();
      Alert::success('Success', 'Data berhasil dihapus');
      return redirect()->route('menyusun-kata.index');
   }
}
