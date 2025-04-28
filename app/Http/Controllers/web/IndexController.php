<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

use App\Models\AbjadAlfabet;

 class IndexController extends Controller
{
    public function index()
    {

        return view('pageweb.index');
    }

    public function menuutama()
    {
        return view('pageweb.menuutama');
    }

    public function mengenalabjad()
    {
        $alfabet = AbjadAlfabet::all();
        return view('pageweb.mengenalabjad', compact('alfabet'));
    }
}
