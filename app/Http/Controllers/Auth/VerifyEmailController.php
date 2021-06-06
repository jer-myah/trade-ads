<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            switch($request->user->role){
                case('user'): return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
                    break;
                case('voluntary-trader'): return redirect()->intended(RouteServiceProvider::VOLUNTARYTRADER.'?verified=1');
                    break;
                case('top-trader'): return redirect()->intended(RouteServiceProvider::TOPTRADER.'?verified=1');
                    break;
                case('administrator'): return redirect()->intended(RouteServiceProvider::SUPERADMINISTRATOR.'?verified=1');
                    break;
                default: return redirect()->back();
            }
            
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        switch($request->user->role){
            case('user'): return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
                break;
            case('voluntary-trader'): return redirect()->intended(RouteServiceProvider::VOLUNTARYTRADER.'?verified=1');
                break;
            case('top-trader'): return redirect()->intended(RouteServiceProvider::TOPTRADER.'?verified=1');
                break;
            case('administrator'): return redirect()->intended(RouteServiceProvider::SUPERADMINISTRATOR.'?verified=1');
                break;
            default: return redirect()->back();
        }
    }
}
