<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(): RedirectResponse
    {
        $validated = request()->validate([
            'current_password' => ['required', 'current_password:web'],
            'password' => ['required', 'confirmed', \App\Rules\Password::default()],
        ]);

        request()->user()->update([
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
        ]);

        return back()->withStatus('Password updated successfully.');
    }
}