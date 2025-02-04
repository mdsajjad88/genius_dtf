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
        return view('marchent.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(route('dashboard', absolute: false));
    // }
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        // Check if email exists
        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'The provided email is not registered.',
            ])->withInput();
        }

        // Check if password is incorrect
        if (!\Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'The password is incorrect.',
            ])->withInput();
        }

        // If both are correct, attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // // Redirect based on role
            // return redirect()->intended(match ($user->role) {
            //     'admin' => route('dashboard'),
            //     'merchant' => route('marchent.index'),
            //     'user' => route('dashboard'),
            //     default => route('dashboard'),
            // });
            if ($user->role == 'marchent') {
                return redirect()->route('marchent.index');
            }
            if ($user->role == 'admin') {
                return redirect()->route('admin-dashboard.index');
            }
            else{
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
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
