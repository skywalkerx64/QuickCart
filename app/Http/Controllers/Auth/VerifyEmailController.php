<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = User::find($request->user()->id);



        if ($request->user()->hasVerifiedEmail()) {
            if ($user->hasRole([Role::ADMIN_ROLE_ALIAS])) {
                return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
            }
            return redirect()->intended(route('home', absolute: false) . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if ($user->hasRole([Role::ADMIN_ROLE_ALIAS])) {
            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
        }
        return redirect()->intended(route('home', absolute: false) . '?verified=1');
    }
}
