<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function profile(Request $request)
    {
        return view('auth.profile', ['user' => $request->user()]);
    }
    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|confirmed'
        ]);
        $user = $request->user();
        $user->update(['password' => $validated['new_password']]);
        return to_route('home');
    }
}
