<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  LoginRequest $request
     * @return RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = $request->user();

        if ($user->usertype === 'admin') {
            return redirect(route('admin.dashboard'));
        } elseif ($user->usertype === 'siswa') {
            return redirect(route('siswa.dashboard'));
        } elseif ($user->usertype === 'user') {
            return redirect()->intended(route('dashboard'));
        } else {
            Auth::logout();  // Ensure we log out users with unrecognized types
            return redirect('/login')->withErrors(['usertype' => 'Your user type is not recognized.']);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
