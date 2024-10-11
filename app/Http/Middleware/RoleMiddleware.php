<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        return $next($request);



        if (!Auth::check()) {
            return redirect('/login'); // Arahkan ke halaman login jika belum login
        }

        // Dapatkan user yang sedang login
        $user = Auth::user();

        // Cek apakah user memiliki role yang diizinkan
        if ($user->role !== $role) {
            // Arahkan ke halaman lain jika role tidak sesuai
            // return redirect('/')->with('error', "You don't have access to this page.");
            abort(403, 'Unauthorized.');

        }

        return $next($request); // Lanjutkan jika role sesuai
    }
}
