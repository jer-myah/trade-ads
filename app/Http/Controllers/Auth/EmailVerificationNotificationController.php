<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            switch($request->user()->role){
                case('user'): return redirect()->intended(RouteServiceProvider::HOME);
                    break;
                case('voluntary-trader'): return redirect()->intended(RouteServiceProvider::TRADER);
                    break;
                case('top-trader'): return redirect()->intended(RouteServiceProvider::TRADER);
                    break;
                case('administrator'): return redirect()->intended(RouteServiceProvider::SUPERADMINISTRATOR);
                    break;
                default: return redirect()->back();
            }
            
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
