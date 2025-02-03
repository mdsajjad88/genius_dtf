<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class MarchentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function showRegisterForm()
    {
        return view('marchent.register');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'shop_name' => $request->shop_name,
                'password' => bcrypt($request->password),
            ]);

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
                'message' => 'Something went wrong. Please try again later!'
            ], 500);
        }
    }



    public function login()
    {
        return view('marchent.login');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
