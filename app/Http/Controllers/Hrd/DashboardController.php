<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('hrd.dashboard');
    }
}

