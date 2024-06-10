<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Siswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the 'Siswa' usertype
        if (Auth::check() && Auth::user()->usertype === 'siswa') {
            return $next($request);
        }

        // Redirect all other users
        return redirect('dashboard')->with('error', "You do not have access to the Siswa page.");
    }
}
