<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BelajarMembaca;
 class WebBelajarMembacaController extends Controller
{


    public function index()
    {
        return view('pageweb.belajarmembaca');
    }

    public function getBelajarMembaca()
    {
        $reading = BelajarMembaca::first(); // Ambil satu data pertama
        return response()->json($reading->konten); // Kembalikan dalam format JSON
    }

}
