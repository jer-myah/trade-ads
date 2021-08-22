<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Referral;
use App\Models\Account;
use App\Models\Advert;
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
        $adverts = Advert::where('status', true)->limit(50)->latest()->get(); 
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'adverts' => $adverts,
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
    public function store(Request $request)
    {
        
        $user = new User();
        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->status = $request->status;
        
        $user->save();

        $alpha_num = Str::random(6).Str::random(6);
        $ref_code = strtoupper(str_shuffle($alpha_num));
        
        Referral::create([
            'user_id' => $user->id,
            'ref_code' => $ref_code,
        ]);

        Account::create([
            'user_id' => $user->id,
            'main_balance' => 0.00,
            'trading_balance' => 0.00, 
        ]);

        return redirect('/login')->with('flash_message_success', 'Registration was successful!');
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
