<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class roleSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == "Admin") {
            return $next($request);
        }

        // Jika tidak punya akses yaitu belum login dan level bukan admin
        $mess = [
            "type" => "warning",
            "text" => "Maaf anda tidak punya akses"
        ];
        return redirect('/')->with($mess);
    }
}
