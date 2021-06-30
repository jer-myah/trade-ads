<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

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
        try {
            $user = User::where('id', $id)->first();

            return Inertia::render('Admin/Users/Show', ['user' => $user]);
        
        } catch(\Exception $e) {
            return redirect()->back();
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