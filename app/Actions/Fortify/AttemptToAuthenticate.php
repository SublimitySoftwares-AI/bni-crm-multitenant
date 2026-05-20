<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\AttemptingAuthentication;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\LoginRateLimiter;

class AttemptToAuthenticate implements AttemptingAuthentication
{
    public function __construct(
        protected LoginRateLimiter $limiter
    ) {}

    /**
     * Attempt to authenticate a user.
     */
    public function __invoke(object $guard, User $user): ?bool
    {
        // Check if user is trying to login to superadmin panel
        if (request()->is('superadmin/*')) {
            if (! $user->hasRole('superadmin')) {
                $this->limiter->increment(request());
                throw ValidationException::withMessages([
                    Fortify::username() => ['You do not have permission to access this area.'],
                ]);
            }
        }

        return null;
    }
}