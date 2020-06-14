<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        if (Auth::user()->is_admin == User::IS_ADMIN) {
            $this->redirectTo = route('admin.home');
            return $this->redirectTo;
        }

        $this->redirectTo = route('officer.home');
        return $this->redirectTo;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            Alert::success('Sukses');
            if (auth()->user()->is_admin == User::IS_ADMIN) {
                return redirect()->route('admin.home');
            }
            else {
                return redirect()->route('officer.home');
            }
        }
        else {
            Alert::error('Terjadi Kesalahan', 'Email dan Password Anda Tidak Sesuai');
            return redirect()->back();
        }

    }

    public function dashboard(Request $request)
    {
        return "berhasil";
    }

}
