<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Models\MenyusunKata;
use App\Http\Controllers\Controller;
class WebMenyusunKataController extends Controller
{
    public function index()
    {
        return view('pageweb.menyusunkata');
    }

    public function getMenyusunKata()
    {
        $menyusunKata = MenyusunKata::select('soal', 'jawaban', 'gambar')->get();
        return response()->json($menyusunKata);
    }
}
