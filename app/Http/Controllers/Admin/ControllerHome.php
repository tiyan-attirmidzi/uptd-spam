<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ControllerHome extends Controller
{
    public function index()
    {
        return view('home_admin');
    }
}
