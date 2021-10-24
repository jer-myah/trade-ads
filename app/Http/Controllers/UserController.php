<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Account;
use App\Models\Referral;
use App\Models\UserReferred;
use App\Traits\Values;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Advert;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $userInteface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(UserRepositoryInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->userInterface->getAllUsers();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->userInterface->requestUser($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = $this->userInterface->getUserById(Auth::user()->id);

        return Inertia::render('Users/Profile', ['user', $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->userInterface->requestUser($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->userInterface->deleteUser($id);
    }

    // User dashboard
    public function dashboard() {
        $advert = Advert::where('user_id', Auth::user()->id)->count();
        $balance = Account::where('user_id', Auth::user()->id)->pluck('main_balance');        
        
        return Inertia::render('Users/Dashboard', ['advert' => $advert, 'balance' => $balance[0]]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);
    
        if(Hash::check($request->old_password, Auth::user()->password)){
            User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->password)]);
            return back()->with('success', 'Password updated successfully!');
        }

        return back()->with('warning', 'Invalid Password!');
    }


    public function updateAvatar(Request $request)
    { 
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:5026'
        ]);

        $path = $request->avatar->store('avatars', 'public');

        User::where('id', Auth::user()->id)->update(['avatar' => $path]);

        return back()->with('success', 'Profile image updated successfully.');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     Interfaceall();

    //     return Inertia::render('Admin/Users/Index', ['users' => $users]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approveTrader($id)
    {
        User::where('id', $id)->update([
            'status' => 'active'
        ]);

        $alpha_num = Str::random(6).Str::random(6);
        $ref_code = strtoupper(str_shuffle($alpha_num));
        
        $referral = Referral::create([
            'user_id' => $id,
            'ref_code' => $ref_code,
        ]);

        UserReferred::create([
            'referral_id' => $referral->id,
            'user_id' => $id,
            'count' => 0,
        ]);

        Account::create([
            'user_id' => $id,
            'main_balance' => 0.00,
            'trading_balance' => 0.00, 
        ]);

        return back()->with('success', 'User account has been approved!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
        //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accountInformation() {
        return $this->userInterface->getAccountInformation();
    }

    /**
     * Show the user profile.
     * 
     * 
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = User::where('id', Auth::user()->id)->with('referral')->first();
        
        return Inertia::render('Traders/Profile', ['user' => $user]);
    }

    public function userProfile()
    {
        $user = User::where('id', Auth::user()->id)->first();

        return Inertia::render('Users/Profile', ['user' => $user]);
    }


    
}
