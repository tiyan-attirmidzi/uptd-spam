<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ControllerHome extends Controller
{
    public function index()
    {
        // toast('Registrasi Pengguna Baru Berhasil','success')->autoClose(2000);
        // toast('Signed in successfully','success')->timerProgressBar();
        // Alert::error('Error Title', 'Error Message');
        return view('pages.admin.home');
    }
}
