<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        
        if($request->user()->role == 'user'){
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        if($request->user()->role == 'administrator'){
            return redirect()->intended(RouteServiceProvider::SUPERADMINISTRATOR);
        }

        if($request->user()->role == 'top-trader' || $request->user()->role == 'voluntary-trader'){
            // return redirect()->intended(RouteServiceProvider::TOPTRADER);
            return redirect()->intended(RouteServiceProvider::TRADER);
        }

        // if($request->user()->role == 'voluntary-trader'){
        //     return redirect()->intended(RouteServiceProvider::VOLUNTARYTRADER);
        // }
        
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
