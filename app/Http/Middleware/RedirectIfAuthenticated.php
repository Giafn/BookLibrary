<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        $login = false;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $login = true;
            }
        }
        if ($login == true) {
            if (Auth::user()->is_admin == Null) {
                return redirect(RouteServiceProvider::HOME);
            } elseif (Auth::user()->is_admin == 1){
                return redirect(RouteServiceProvider::ADMIN);
            }
        }

        return $next($request);
    }
}
