<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardSuperdminController extends Controller
{
    public function index()
    {
        return view('pageadmin.dashboard.index');
    }
}
