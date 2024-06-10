<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Guru
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the 'guru' usertype
        if (Auth::check() && Auth::user()->usertype === 'guru') {
            return $next($request);
        }

        // Redirect all other users
        return redirect('dashboard')->with('error', "You do not have access to the Siswa page.");
    }
}
