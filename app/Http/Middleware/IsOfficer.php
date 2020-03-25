<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use RealRashid\SweetAlert\Facades\Alert;

class IsOfficer
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
        if (auth()->user()->is_admin == User::IS_OFFICER) {
            return $next($request);
        }

        Alert::error('Mohon Maaf', 'Anda Tidak Berhak Mengakses');
        return redirect()->back();
    }
}
