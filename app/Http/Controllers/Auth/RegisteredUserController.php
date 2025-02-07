<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('marchent.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    try {
        \Log::info('Request data: ' . json_encode($request->all()));
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'shop_name' => 'required|string|max:255',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'shop_name' => $request->shop_name,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Registration successful!',
            ]);
        }

        // Regular form submission (non-AJAX)
        return redirect()->route('login')->with('success', 'Registration successful!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        }
        return back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        \Log::error('Registration Error: ' . $e->getMessage());
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during registration.',
            ], 500);
        }

        return redirect()->route('register')->with('error', 'An error occurred during registration.');
    }
}


}
