<?php

namespace App\Repositories;

use App\Interfaces\AdvertRepositoryInterface;
use App\Models\Advert;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AdvertRepository implements AdvertRepositoryInterface
{
    // Use ResponseAPI Trait in this repository

    public function getAllAdverts()
    {
        try {
            $adverts = Advert::all();
            return Inertia::render('User/Adverts/Index', ['adverts' => $adverts]);
        } catch(\Exception $e) {
            return redirect()->back();
        }
    }

    public function getAdvertById($id)
    {
        try {
            $adverts = Advert::where('id', $id)->first();

            return Inertia::render('Admin/Adverts/Show', ['user' => $adverts]);
        
        } catch(\Exception $e) {
            return redirect()->back();
        }
    }
    

    public function deleteAdvert($id)
    {
        try{
            if(Advert::where('id', $id)->exists()){
                Advert::where('id', $id)->delete();
                return Inertia::render('Admin/Adverts/Index');
            }

            return redirect()->back();

        } catch(\Exception $e) {
            return redirect()->back();
        }
    }

}