<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->is_admin == User::IS_ADMIN || auth()->user()->is_admin == User::IS_OFFICER) {
            return $next($request);
        }

        return redirect('/')->with('message','Maaf, Akun Anda Tidak Berhak Untuk Mengakses Halaman Ini');
    }
}
