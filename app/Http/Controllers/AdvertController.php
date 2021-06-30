<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\Account;
use App\Models\AdvertPackage;
use App\Models\AdvertCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'administrator'){
            $adverts = Advert::all();
            return Inertia::render('Admin/Adverts/Index', ['adverts' => $adverts]);
        }
        
        $adverts = Advert::where('user_id', Auth::user()->id)->get();
        return Inertia::render('Users/Adverts', ['adverts' => $adverts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $advertPackages = AdvertPackage::where('status', true)->get();
        $advertCategories = AdvertCategory::where('status', true)->get();
        return Inertia::render('Users/CreateAdvert', ['advertCategories' => $advertCategories, 'advertPackages' => $advertPackages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $plan = AdvertPackage::where('id', $request->package_id)->first();
        
        $account = Account::where('user_id', Auth::user()->id)->first();
        
        if($account->main_balance < $plan->amount){
            return back()->with('warning', 'You do not have sufficient fund to perform this operation!');
        }
        
        $request->validate([
            'title' => 'required|filled|unique:adverts|string|max:128',
            'description' => 'required|max:512',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:5220',
            'video' => 'nullable|mimetypes:video/mpeg',
            'phone' => 'required|max:20'
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image')->store('adverts_images', 'public');
        }

        $advert = Advert::create([
            'advert_package_id' => $request->package_id,
            'advert_category_id' => $request->selected,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
            'amount' => $plan->amount,
            'phone' => $request->phone,
            'user_id' => Auth::user()->id,
        ]);

        Account::where('user_id', Auth::user()->id)->update([
            'main_balance' => $account->main_balance - $plan->amount,
        ]);

        if($request->hasFile('video')){
            $video = $request->file('video')->store('adverts_videos', 'public');

            Advert::where('id', $advert->id)->update([
                'video' => $video
            ]);
        }

        return redirect('/user-adverts')->with('success', 'Advert was created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Advert::where('id', $id)->doesntExist()){
            return back()->with('warning', 'There seems to be an error with this request!');
        }

        $advert = Advert::where('id', $id)->first();
        return Inertia::render('Admin/Adverts/Show', ['advert' => $advert]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advert = Advert::where('id', $id)->first();
        $category = AdvertCategory::where('id', $advert->advert_category_id)->first();
        $plan = AdvertPackage::where('id', $advert->advert_package_id)->first();

        return Inertia::render('Users/EditAdvert', ['advert' => $advert, 'category' => $category, 'plan' => $plan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advert $advert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advert $advert)
    {
        //
    }
}
