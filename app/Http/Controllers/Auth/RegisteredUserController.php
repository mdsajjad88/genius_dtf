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
    public function store(Request $request): RedirectResponse
    {
        try {
            \Log::info('Request data: ' . json_encode($request->all()));

            // Validate input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'shop_name' => 'required|string|max:255',
                'password' => 'required|min:6',
            ]);

            // Create user
           $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'shop_name' => $request->shop_name,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));

            // Auth::login($user);
            // Return success response for AJAX
            return response()->json([
                'success' => true,
                'message' => 'Registration successful!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Get validation errors and return as response
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422); // HTTP Status 422 for validation errors
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Registration Error: ' . $e->getMessage());

            // Return error response for AJAX
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }

    }
}
