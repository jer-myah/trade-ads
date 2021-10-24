<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\BitcoinPayment;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    // Use ResponseAPI Trait in this repository

    public function getAllUsers()
    {
        try {
            $users = User::where('role', '!=', 'administrator')->where('status', 'active')->get();
            $traders = User::where('role', '=', 'voluntary-trader')->where('status', 'in-active')->get();
            return Inertia::render('Admin/Users/Index', ['users' => $users, 'traders' => $traders]);
        } catch(\Exception $e) {
            return redirect()->back();
        }
    }

    public function getUserById($id)
    {
        return User::where('id', $id)->first();        
    }

    public function getAccountInformation()
    {
        try{ 
            $user = User::where('id', Auth::user()->id)->with('referral', 'account')->first();
            $payments = BitcoinPayment::where('email', Auth::user()->email)->get();
            return Inertia::render('Users/AccountInformation', ['user' => $user, 'payments' => $payments]); 
        }catch(\Exception $exception){
            return back()->with('warning', 'Unable to get account information!');
        }   
    }
    

    public function deleteUser($id)
    {
        try{
            if(User::where('id', $id)->exists()){
                User::where('id', $id)->delete();
                return Inertia::render('Admin/Users/Index');
            }

            return redirect()->back();

        } catch(\Exception $e) {
            return redirect()->back();
        }
    }

}