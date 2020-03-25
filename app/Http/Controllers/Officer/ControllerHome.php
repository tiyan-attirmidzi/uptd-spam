<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ControllerHome extends Controller
{
    public function index()
    {
        return view('pages.officer.home');
    }
}
