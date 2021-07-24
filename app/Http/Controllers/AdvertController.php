<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\Account;
use App\Models\AdvertPackage;
use App\Models\AdvertCategory;
use App\Models\Link;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

        // $user_id = Auth::user()->id;

        $advert = new Advert();
        $advert->advert_package_id = $request->package_id;
        $advert->advert_category_id = $request->selected;
        $advert->title = $request->title;
        $advert->description = $request->description;
        $advert->image = $image;
        $advert->amount = $plan->amount;
        $advert->phone = $request->phone;
        $advert->user_id = Auth::user()->id;
        
        try{
            $advert->save();
        }catch (\Exception $exception){
            return back()->with('warning', $exception);
        }

        Account::where('user_id', Auth::user()->id)->decrement('main_balance', $plan->amount);

        if($request->hasFile('video')){
            $video = $request->file('video')->store('adverts_videos', 'public');

            Advert::where('id', $advert->id)->update([
                'video' => $video
            ]);
        }

        // create link
        if(Link::count() < 1){
            $link = new Link();

            $link->link = Str::random(16);
            $link->advert_id = $advert->id;
            $link->duration = $plan->days; // number of days
            $link->total_hours = ($plan->days * 24);

            $link->save();

            return redirect('/user-adverts')->with('success', 'Advert was created successfully!');
        }

        if(Link::where('status', 'active')->where('percentage', '<', 30)->exists()){
            $link = Link::where('status', 'active')->where('percentage', '<', 30)->first();
            Link::where('id', $link->id)->increment('total_increment', $plan->series);
            
            $percentage = ($link->total_increment / ($link->total_hours + $plan->series)) * 100;
            
            Link::where('id', $link->id)->increment('percentage', $percentage);

            return redirect('/user-adverts')->with('success', 'Advert was created successfully!');
        }

        Link::where('status', 'active')->where('percentage', '>', 30)->update([
            'status' => 'in-active'
        ]);

        $link = new Link();

        $link->link = Str::random(16);
        $link->advert_id = $advert->id;
        $link->duration = $plan->days;
        $link->total_hours = ($plan->days * 24); // convert to days

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

        $advert = Advert::where('id', $id)->with('advertPackage', 'advertCategory')->first();
        $plan = $advert->advertPackage->name;
        $cat = $advert->advertCategory->name;
        return Inertia::render('Admin/Adverts/Show', ['advert' => $advert, 'plan' => $plan, 'cat' => $cat]);
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

    public function approveAdvert($id)
    {
        if(Advert::where('id', $id)->doesntExist()){
            return back()->with('warning', 'Record not found!');
        }

        Advert::where('id', $id)->update([
            'status' => 1,
        ]);

        return back()->with('success', 'Advert has been approved!');
    }

    public function deleteAdvert($id)
    {
        if(Advert::where('id', $id)->doesntExist()){
            return back()->with('warning', 'Record not found!');
        }

        $advert = Advert::where('id', $id)->first();

        Storage::disk('public')->delete($advert->image);

        if($advert->video){
            Storage::disk('public')->delete($advert->video);
        }

        Advert::where('id', $id)->delete();

        return back()->with('success', 'Advert has been deleted successfully!');

    }
}
