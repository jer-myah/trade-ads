<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertUpdateRequest;
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
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
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

        $advert = new Advert();   
        
        $advert->advert_package_id = $input['package_id'];
        $advert->advert_category_id = $input['selected'];
        $advert->title = $input['title'];
        $advert->description = $input['description'];
        $advert->amount = $input['price'];
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

        if($request->hasFile('image_1')){
            $request->validate(['image_1' => 'image|mimes:png,jpg,jpeg|max:5220']);
            $image_1 = $request->file('image_1')->store('adverts_images', 'public');

            Advert::where('id', $advert->id)->update([
                'image_1' => $image_1
            ]);
        }

        if($request->hasFile('image_2')){
            $request->validate(['image_2' => 'image|mimes:png,jpg,jpeg|max:5220']);
            $image_2 = $request->file('image_2')->store('adverts_images', 'public');

            Advert::where('id', $advert->id)->update([
                'image_2' => $image_2
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
        if(App::environment() == 'production'){
            $env = 'https://trade-ads1.com';
        }
        $env = 'http://localhost:3000';
        return Inertia::render('Admin/Adverts/Show', ['advert' => $advert, 'plan' => $plan, 'cat' => $cat, 'env' => $env]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advert  $advert
     * @return \Illuminate\Http\Response
     */
    public function viewAdvert($id)
    {
        if(Advert::where('id', $id)->doesntExist()){
            return back()->with('warning', 'There seems to be an error with this request!');
        }

        $advert = Advert::where('id', $id)->with('advertPackage', 'advertCategory', 'link')->first();
        $plan = $advert->advertPackage->name;
        $cat = $advert->advertCategory->name;
        if(App::environment() == 'production'){
            $env = 'https://trade-ads1.com';
        }
        $env = 'http://localhost:3000';

        return Inertia::render('Users/ViewAdvert', ['advert' => $advert, 'plan' => $plan, 'cat' => $cat, 'env' => $env]);
        
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
    public function update(AdvertUpdateRequest $request, Advert $advert, $advert_id)
    {
        try{
            $advert->where('id', $advert_id)->update([
                'title' => $request['title'],
                'description' => $request['description'],
                'phone_num' => $request['phone'],
            ]);
        }catch(\Exception $e){
            return back()->with(['warning' => 'Internal server error']);
        }
        
        return redirect('/user-adverts')->with(['success' => 'Advert updated successfully!']);
        
    }

    public function updateImage(Request $request, $advert_id)
    {
        $advert = Advert::where('id', $advert_id)->first();

        if($request->hasFile('image')){
            $request->validate(['image' => 'image|mimes:png,jpg,jpeg|max:5220']);
            $image = $request->file('image')->store('adverts_images', 'public');

            if($advert->image != null){ 
                            
                try{
                    Advert::where('id', $advert_id)->update([
                        'image' => $image
                    ]);
                }catch(\Exception $e){}

            }else{
                $path = $advert->image;
                if(Storage::exists($path)){
                    Storage::delete($path);
                }
            }
        }

        if($request->hasFile('image_1')){
            $request->validate(['image_1' => 'image|mimes:png,jpg,jpeg|max:5220']);
            $image_1 = $request->file('image_1')->store('adverts_images', 'public');

            if($advert->image_1 != null){
            
                try{
                    Advert::where('id', $advert_id)->update([
                        'image_1' => $image_1
                    ]);
                }catch(\Exception $e){
                }
            }else{
                $path_1 = $advert->image_1;
                if(Storage::exists($path_1)){
                    Storage::delete($path_1);
                }
            }
        }

        if($request->hasFile('image_2')){
            $request->validate(['image_2' => 'image|mimes:png,jpg,jpeg|max:5220']);
            $image_2 = $request->file('image_2')->store('adverts_images', 'public');

            if($advert->image_2 == null){
                try{
                    Advert::where('id', $advert_id)->update([
                        'image_2' => $image_2
                    ]);
                }catch(\Exception $e){

                }
            }else{
                $path_2 = $advert->image_2;
                if(Storage::exists($path_2)){
                    Storage::delete($path_2);
                }
            }
        }

        if($request->hasFile('video')){
            $request->validate(['video' => 'file|mimes:mpeg,mp4|max:5220']);
            $video = $request->file('video')->store('adverts_videos', 'public');

            if($advert->video == null){
                try{
                    Advert::where('id', $advert_id)->update([
                        'video' => $video
                    ]);
                }catch(\Exception $e){
                    return back()->with('warning', 'Error while proccessing video update!');
                }
            }else{
                $path_video = $advert->video;

                if(Storage::exists($path_video)){
                    Storage::delete($path_video);
                }
            }
        }

        return redirect('/user-adverts')->with(['success' => 'Updated successfully']);
    }

    public function showByCategory($category_id)
    {
        $cats = AdvertCategory::where('status', 1)->get();
        $cat = AdvertCategory::select('name')->where('id', $category_id)->first();

        if($category_id == 'All'){
            $adverts = Advert::where('status', true)->with('advertCategory')->get();
            return redirect('/');
        }

        $adverts = Advert::where('advert_category_id', $category_id)->where('status', true)->with('advertCategory')->get();
        
        return Inertia::render('ListingByCategory', ['adverts' => $adverts, 'cats' => $cats, 'cat' => $cat]);
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

        if(App::environment() == 'production'){
            $env = 'https://trade-ads1.com';
        }
        $env = 'http://localhost:3000';

        $advert = Advert::where('id', $advert_id)->with('advertCategory')->first();
        $relateds = Advert::where('advert_category_id', $advert->advert_category_id)->inRandomOrder()->limit(24)->get();
        return Inertia::render('AdvertDetails', ['advert' => $advert, 'relateds' => $relateds, 'env' => $env]);
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
