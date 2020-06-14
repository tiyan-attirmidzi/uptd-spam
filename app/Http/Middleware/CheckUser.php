<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUser
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
        if ($request->user()) {
            if (Auth::user()->is_admin == User::IS_ADMIN) {
                return route('admin.home');
            }

            return route('officer.home');
        }


        return $next($request);
    }
}
