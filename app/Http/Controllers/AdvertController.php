<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvertRequest;
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
use Illuminate\Database\Query\Expression;

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
            $adverts = Advert::orderBy('created_at', 'DESC')->get();
            return Inertia::render('Admin/Adverts/Index', ['adverts' => $adverts]);
        }
        
        $adverts = Advert::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
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
    public function store(StoreAdvertRequest $request)
    { 
        $input = $request->validated();

        $plan = AdvertPackage::where('id', $input['package_id'])->first();
        
        $account = Account::where('user_id', Auth::user()->id)->first();
        
        if($account->main_balance < $plan->amount){
            return back()->with('warning', 'You do not have sufficient fund to perform this operation!');
        }        
        
        if($input['image']){
            $image = $request->file('image')->store('adverts_images', 'public');
        }

        // $user_id = Auth::user()->id;

        $advert = new Advert();
        $advert->advert_package_id = $input['package_id'];
        $advert->advert_category_id = $input['selected'];
        $advert->title = $input['title'];
        $advert->description = $input['description'];
        $advert->amount = $plan->amount;
        $advert->image = $image;
        $advert->phone_num = $input['phone_num'];
        $advert->user_id = Auth::user()->id;
        
        try {
            $advert->save();
            Account::where('user_id', Auth::user()->id)->decrement('main_balance', $plan->amount);

        } catch (\Exception $exception){
            return back()->with('warning', $exception->getMessage());
        }

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

            Advert::where('id', $advert->id)->update(['link_id' => $link->id]);

            return redirect('/user-adverts')->with('success', 'Advert was created successfully!');
        }

        // create link when no link is active
        if(Link::where('status', 'active')->doesntExist()){

            $link = new Link();

            $link->link = Str::random(16);
            $link->advert_id = $advert->id;
            $link->duration = $plan->days;
            $link->total_hours = ($plan->days * 24); // convert to days

            $link->save();

            Advert::where('id', $advert->id)->update(['link_id' => $link->id]);

            return redirect('/user-adverts')->with('success', 'Advert was created successfully!');

        }

        // add series to active link
        if(Link::where('status', 'active')->where('percentage', '<', 30)->exists()){
            
            $link = Link::where('status', 'active')->where('percentage', '<', 30)->first();
            Link::where('id', $link->id)->increment('total_increment', $plan->series);
            Link::where('id', $link->id)->update(['total_hours' => ($link->total_hours + $plan->series)]);
            
            $percentage = ($link->total_increment / ($link->total_hours + $plan->series)) * 100;
            
            Link::where('id', $link->id)->update(['percentage' => ($link->percentage + $percentage)]);
            // Link::where('id', $link->id)->increment('percentage', $percentage);

            Advert::where('id', $advert->id)->update(['link_id' => $link->id]);

            return redirect('/user-adverts')->with('success', 'Advert was created successfully!');
        }

        // deactivate previous link and create nw one if percentage increase is more than 30
        if(Link::where('status', 'active')->where('percentage', '>', 30)){
            
            Link::where('status', 'active')->where('percentage', '>', 30)->update([
                'status' => 'in-active'
            ]);

            $link = new Link();

            $link->link = Str::random(16);
            $link->advert_id = $advert->id;
            $link->duration = $plan->days;
            $link->total_hours = ($plan->days * 24); // convert to days

            Advert::where('id', $advert->id)->update(['link_id' => $link->id]);

            return redirect('/user-adverts')->with('success', 'Advert was created successfully!');
        }
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

        $advert = Advert::where('id', $id)->with('advertPackage', 'advertCategory', 'link')->first();
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

    public function advertDetails($advert_id)
    {
        if(Advert::where('id', $advert_id)->doesntExist()){
            return back()->with('warning', 'Unable to find the resource.');
        }

        $advert = Advert::where('id', $advert_id)->first();
        $relateds = Advert::where('advert_category_id', $advert->advert_category_id)->inRandomOrder()->limit(24)->get();
        return Inertia::render('AdvertDetails', ['advert' => $advert, 'relateds' => $relateds]);
    }

    public function deactivate($id)
    {
        if(Advert::where('id', $id)->doesntExist()){
            return back()->with('warning', 'Bad Request!');
        }

        Advert::where('id', $id)->update([
            'status' => 0
        ]);

        return back()->with('success', 'Advert has been deactivated successfully!');
    }
    
}
