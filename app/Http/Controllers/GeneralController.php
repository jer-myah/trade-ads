<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Referral;
use App\Models\UserReferred;
use App\Models\Account;
use App\Models\Advert;
use App\Models\AdvertCategory;
use App\Traits\Values;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Inertia\Inertia;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = AdvertCategory::where('status', 1)->get();
        $adverts = Advert::select('id', 'title', 'image', 'amount')->where('status', true)->with('advertCategory')->limit(50)->latest()->get(); 
        $ads_videos = Advert::select('video')->where('status', true)->where('video', '!=', null)->limit(30)->latest()->get();

        if(App::environment() == 'production'){
            $env = 'https://trade-ads1.com';
        }
        $env = 'http://localhost:3000';
        
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'adverts' => $adverts,
            'cats' => $cats,
            'env' => $env,
            'ads_videos' => $ads_videos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
        
        $input = $request->validated();

        $user = new User();
        
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->country = $input['country'];
        $user->password = Hash::make($input['password']);
        $user->role = Values::ROLE['VOLUNTARY'];
        $user->status = Values::DEACTIVATE_STATUS;
        $user->ip_address = $request->ip();
        
        $user->save();

        if($request->has('ref_code') && !empty($request->ref_code)){
            $referral = Referral::where('ref_code', $request->ref_code)->first();
            
            if(UserReferred::where('referral_id', $referral->id)->exists()){
                UserReferred::where('referral_id', $referral->id)->increment('count');
            }else{
                UserReferred::create([
                    'referral_id' => $referral->id,
                    'user_id' => $user->id,
                    'count' => 1
                ]);
            }
        }

        $this->createReferral($user->id);

        $this->createAccount($user->id);

        return redirect('/login')->with('flash_message_success', 'Registration was successful!');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function credit()
    {
        $accounts = Account::get();
        return Inertia::render('CreditAccount', ['accounts' => $accounts]);
    }

    public function creditId($id)
    { 
        Account::where('id', $id)->increment('main_balance', 50);
        return back();

    }

}
