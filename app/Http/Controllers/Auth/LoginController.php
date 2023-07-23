<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Memproses data login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return $this->authenticated($request); // Redirect to the appropriate dashboard based on role
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Handle an authenticated user after the login process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
        } elseif (Auth::user()->isStaff()) {
            return redirect()->route('staff.dashboard'); // Redirect to staff dashboard
        } elseif (Auth::user()->isBuyer()) {
            return redirect()->route('buyer.dashboard'); // Redirect to buyer dashboard
        } else {
            return redirect()->route('home'); // Default fallback redirection
        }
    }

    /**
     * Logout user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
