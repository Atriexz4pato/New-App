<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        //check user role and redirect accorldingly

        $user = auth()->user();

        if ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        } elseif ($user->role === 'assessor') {
            return redirect()->route('assessor.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard'); // Default dashboard
        }elseif  ($user->role === 'super_admin'){
            return redirect()->route('super_admin.dashboard');
        }

            return redirect()->intended(route('', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
