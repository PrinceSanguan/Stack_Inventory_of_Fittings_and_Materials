<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view ('welcome');
    }

    public function loginForm(Request $request)
    {
        // Validate the retrieved data
        $validatedData = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        // Attempt to find the user by email
        $user = User::where('email', $validatedData['email'])->first();

        // Check if user exists and password matches
        if ($user && Hash::check($validatedData['password'], $user->password)) {
            // Log the user in
            Auth::login($user);

            // Check user role and redirect accordingly
            if ($user->userRole === 'admin') {
                return redirect()->route('admin.purchase');
            }
        } else {
            return redirect()->route('welcome')->with(['error' => 'Invalid email or password']);
        }
    }
}
