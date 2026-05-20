<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     */
    public function store(): RedirectResponse
    {
        request()->validate([
            'email' => ['required', 'email'],
        ]);

        $status = \Illuminate\Support\Facades\Password::sendResetLink(
            request()->only('email')
        );

        return $status == \Illuminate\Support\Facades\Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}