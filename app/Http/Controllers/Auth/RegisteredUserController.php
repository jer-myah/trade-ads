<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Models\Referral;
use App\Models\Account;
use App\Models\UserReferred;
use Illuminate\Support\Str;
use App\Traits\Values;

class RegisteredUserController extends Controller
{

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $countries = Values::COUNTRIES;
        return Inertia::render('Auth/Register', ['countries' => $countries]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreUserRequest $request)
    {
        if($request->has('ref_code') && !empty($request->ref_code)){
            if(Referral::where('ref_code', $request->ref_code)->doesntExist()) {
                return back()->with('warning', 'Referral code is invalid.');
            }
        }

        if(User::where('ip_address', $request->ip())->exists()) {
            return back()->with('warning', 'Unabled to register this time.');
        }

        // $ip = $_SERVER['REMOTE_ADDR'];

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'country' => $request->country,
            'password' => Hash::make($request->password),
            'role' => Values::ROLE['USER'],
            'ip_address' =>  $request->ip(),
        ]);

        if($request->has('ref_code') && !empty($request->ref_code)){
            $referral = Referral::where('ref_code', $request->ref_code)->first();

            if(UserReferred::where('referral_id', $referral->id)->exists()){
                UserReferred::where('referral_id', $referral->id)->increment('count');
            }else{
                UserReferred::create([
                    'referral_id' => $referral->id,
                    'user_id' => $user->id,
                    'count' => 0
                ]);
            }
        }

        $this->createReferral($user->id);

        $this->createAccount($user->id);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
        
    }

    /**
     *  @param User ID
     */
    public function createReferral($user)
    {
        $alpha_num = Str::random(6).Str::random(6);
        $ref_code = strtoupper(str_shuffle($alpha_num));
        
        Referral::create([
            'user_id' => $user,
            'ref_code' => $ref_code
        ]);
    }

    /**
     *  Create user monetary account
     *  @param User ID
     */
    public function createAccount($user)
    {
        Account::create([
            'user_id' => $user,
            'main_balance' => 0.00,
            'trading_balance' => 0.00
        ]);
    }

}
