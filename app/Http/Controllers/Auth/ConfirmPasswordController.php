<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ConfirmPasswordController extends Controller
{
    /**
     * Display the password confirmation view.
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     */
    public function store(): RedirectResponse
    {
        request()->validate([
            'password' => ['required', 'current_password:web'],
        ]);

        return redirect()->intended();
    }
}