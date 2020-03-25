<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ControllerHome extends Controller
{
    public function index()
    {
        return view('pages.admin.home');
    }
}
