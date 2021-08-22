<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Account;
use App\Models\Referral;
use App\Models\UserReferred;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
    public function show($id)
    {
        return $this->userInterface->getUserById($id);
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


    private $userRepository;

    // public function __construct(UserRepositoryInterface $userRepository)
    // {
    //     $this->userRepository = $userRepository;

    // }

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
        //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
