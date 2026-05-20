<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(): View
    {
        return view('auth.reset-password');
    }

    /**
     * Handle an incoming new password request.
     */
    public function store(): RedirectResponse
    {
        request()->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', \App\Rules\Password::default()],
        ]);

        $status = \Illuminate\Support\Facades\Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => \Illuminate\Support\Facades\Hash::make(request()->password),
                ])->save();
            }
        );

        return $status == \Illuminate\Support\Facades\Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput(request()->only('email'))->withErrors(['email' => __($status)]);
    }
}