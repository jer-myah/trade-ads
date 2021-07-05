<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Link;

class TradersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Traders/Dashboard');
    }

    /**
     * Display a listing of the available links.
     *
     * @return \Illuminate\Http\Response
     */
    public function availableLinks()
    {
        $available_links = Link::where('status', 'active')->where('shared_with', 'both')->get();
        return Inertia::render('Traders/AvailableLinks', ['available_links' => $available_links]);
    }

    /**
     * Display a listing of the tradeable links.
     *
     * @return \Illuminate\Http\Response
     */
    public function tradeableLinks()
    {
        return Inertia::render('Traders/TradeableLinks');
    }

    /**
     * Display a listing of the trading section .
     *
     * @return \Illuminate\Http\Response
     */
    public function tradingSection()
    {
        return Inertia::render('Traders/TradingSection');
    }

    /**
     * Display a listing of the profile, account information.
     *
     * @return \Illuminate\Http\Response
     */
    public function accountInformation()
    {
        return Inertia::render('Traders/AccountInformation');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
