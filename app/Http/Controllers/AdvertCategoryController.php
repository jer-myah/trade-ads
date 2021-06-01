<?php

namespace App\Http\Controllers;

use App\Models\AdvertCategory;
use App\Models\AdvertPackage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdvertCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = AdvertCategory::where('status', true)->get();
        $packages = AdvertPackage::where('status', true)->get();
        return Inertia::render('Admin/Categories/Index', ['categories' => $categories, 'packages' => $packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Categories/Create');
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
            'description' => 'string|max:255',
        ]);
        
        $category = new AdvertCategory();
        $category->name = $validated['name'];
        $category->description = $validated['description'];
        $category->status = true;

        $category->save();

        return redirect('/admin/view-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdvertCategory  $advertCategory
     * @return \Illuminate\Http\Response
     */
    public function show(AdvertCategory $advertCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdvertCategory  $advertCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(AdvertCategory $advertCategory, $id)
    {
        if(AdvertCategory::where('id', $id)->doesntExist()){
            return redirect()->back()->with('flash_message_error', 'Cannot find Category!');
        };

        $categories = AdvertCategory::where('id', $id)->first();

        return Inertia::render('Admin/Categories/Edit', ['categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdvertCategory  $advertCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:advert_categories|max:255',
            'description' => 'string|max:255',
            'status' => 'boolean|max:10',
        ]);
        
        AdvertCategory::where('id', $id)->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'status' => $validated['status']
        ]);

        return redirect('/admin/view-categories');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdvertCategory  $advertCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(AdvertCategory::doesntExist()){
            return redirect()->back()->with('flash_message_error', 'Cannot find Category!');
        }

        AdvertCategory::where('id', $id)->delete();
        return redirect()->back()->with('flash_message_success', 'Category was deleted successfully!');
    }

    public function disable(Request $request, $id)
    {
        AdvertCategory::where('id', $id)->update([
            'status' => false
        ]);

        return redirect('/admin/view-categories');
    }

    public function enable(Request $request, $id)
    {
        AdvertCategory::where('id', $id)->update([
            'status' => true
        ]);

        return redirect('/admin/view-categories');
    }

}
