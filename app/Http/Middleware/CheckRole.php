<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   // app/Http/Middleware/CheckRole.php
   public function handle($request, Closure $next, $roles)
   {
       // Pisahkan role dengan pipe (|) menjadi array
       $roles = explode('|', $roles);

       // Periksa apakah user yang login memiliki salah satu dari role tersebut
       if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
           return abort(403, 'Unauthorized action.');
       }

       return $next($request);
   }

}
