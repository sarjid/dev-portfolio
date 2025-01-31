<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminAuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        // return Inertia::render('Auth/AdminLogin');
        return Inertia::render('Admin/Auth/Login');
    }


    /**
     * Handle an authentication attempt.
     */

    public function login(AdminLoginRequest $request): RedirectResponse
    {
        $request->authenticateAdmin();
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard', absolute: false));
    }




    public function dashboard(Request $request)
    {
        return Inertia::render('Admin/Dashboard');
        // return Inertia::render('Auth/AdminHome');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('admin.login.view'));
    }
}
