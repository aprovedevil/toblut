<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Redirectusertype
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Mendapatkan rute target yang diminta oleh pengguna
            $routeName = $request->route()->getName();

            switch ($user->usertype) {
                case 'user':
                    // Izinkan hanya untuk mengakses rute dashboard pengguna dan pendaftaran pengguna
                    if ($routeName === 'dashboard' || $routeName === 'user.pendaftaran') {
                        return $next($request);
                    }
                    break;
                case 'admin':
                    // Izinkan hanya untuk mengakses dashboard admin
                    if ($routeName === 'admin.dashboard') {
                        return $next($request);
                    }
                    break;
                case 'siswa':
                    // Izinkan hanya untuk mengakses dashboard siswa
                    if ($routeName === 'siswa.dashboard') {
                        return $next($request);
                    }
                    break;
                case 'guru':
                    // Izinkan hanya untuk mengakses dashboard guru
                    if ($routeName === 'guru.dashboard' || $routeName === 'guru.manajemen' || $routeName === 'guru.materi') {
                        return $next($request);
                    }
                    break;
            }

            // Jika pengguna mencoba mengakses halaman yang tidak sesuai, arahkan ke halaman utama sesuai dengan usertype
            switch ($user->usertype) {
                case 'user':
                    return redirect()->route('dashboard');
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'siswa':
                    return redirect()->route('siswa.dashboard');
                case 'guru':
                    return redirect()->route('guru.dashboard');
                default:
                    // Jika usertype tidak dikenali, kembalikan ke halaman login dengan pesan error
                    return redirect('/login')->withErrors(['error' => 'User type not recognized or unauthorized access.']);
            }
        }

        // Jika pengguna tidak terautentikasi, arahkan ke halaman login.
        return redirect('/login');
    }
}
