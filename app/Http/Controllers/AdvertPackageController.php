<?php

namespace App\Http\Controllers;

use App\Models\AdvertPackage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdvertPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = AdvertPackage::get();
        return Inertia::render('Admin/Packages/Index', ['packages' => $packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Packages/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:advert_categories|max:255',
            'price' => 'required|max:6',
            'days' => 'required|max:6',
            'series' => 'required|max:6',
        ]);

        if($request->photo == 'on'){
            $photo = true;
        }else{
            $photo = false;
        }

        if($request->media == 'on'){
            $media = true;
        }else{
            $media = false;
        }

        if($request->adslink == 'on'){
            $adslink = true;
        }else{
            $adslink = false;
        }
        
        $package = new AdvertPackage();
        $package->name = $validated['name'];
        $package->amount = $validated['price'];
        $package->photo = $photo;
        $package->media = $media;
        $package->adslink = $adslink;
        $package->days = $validated['days'];
        $package->series = $validated['series'];
        $package->status = true;

        $package->save();

        return redirect('/admin/view-packages');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdvertPackage  $advertPackage
     * @return \Illuminate\Http\Response
     */
    public function show(AdvertPackage $advertPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdvertPackage  $advertPackage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = AdvertPackage::where('id', $id)->first();
        return Inertia::render('Admin/Packages/Edit', ['advert_package' => $package]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdvertPackage  $advertPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(! AdvertPackage::where('id', $id)->exists()){
            return redirect()->back()->with('flash_message_error', 'Package does not exists or may have been deleted prevously!');
        }

        $validated = $request->validate([
            'name' => 'required|unique:advert_categories|max:255',
            'price' => 'required|max:6',
            'days' => 'required|max:6',
            'series' => 'required|max:6',
        ]);

        if($request->photo == 'on'){
            $photo = true;
        }else{
            $photo = false;
        }

        if($request->media == 'on'){
            $media = true;
        }else{
            $media = false;
        }

        if($request->adslink == 'on'){
            $adslink = true;
        }else{
            $adslink = false;
        }

        AdvertPackage::where('id', $id)->update([
            'name' => $request->name,
            'amount' => $request->price,
            'photo' => $photo,
            'media' => $media,
            'adslink' => $adslink,
            'days' => $request->days,
            'series' => $request->series
        ]);

        return redirect('/admin/view-packages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdvertPackage  $advertPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(! AdvertPackage::exists()){
            return redirect()->back()->with('flash_message_error', 'Cannot find Package!');
        }

        AdvertPackage::where('id', $id)->delete();
        return redirect()->back()->with('flash_message_success', 'Package was deleted successfully!');
    
    }

    public function disable(Request $request, $id)
    {
        AdvertPackage::where('id', $id)->update([
            'status' => false
        ]);

        return redirect('/admin/view-packages');
    }

    public function enable(Request $request, $id)
    {
        AdvertPackage::where('id', $id)->update([
            'status' => true
        ]);

        return redirect('/admin/view-packages');
    }
}
