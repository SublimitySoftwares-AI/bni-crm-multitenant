<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(): RedirectResponse
    {
        request()->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}