<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\MenyusunKata;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


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
      ]);

      MenyusunKata::create($request->all());
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
      ]);

      $menyusunKata->update($request->all());
      Alert::success('Success', 'Data berhasil diubah');
      return redirect()->route('menyusun-kata.index');
   }

   public function destroy($id)
   {
      $menyusunKata = MenyusunKata::find($id);
      $menyusunKata->delete();
      Alert::success('Success', 'Data berhasil dihapus');
      return redirect()->route('menyusun-kata.index');
   }
}
