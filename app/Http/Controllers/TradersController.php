<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Link;
use App\Models\TradersLink;
use Illuminate\Support\Facades\Auth;

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
        $trader = Account::where('user_id', Auth::user()->id)->first(); 
        $available_links = Link::where('status', 'active')->where('shared_with', 'voluntary')->with('advert')->get();
        // dd($available_links);
        return Inertia::render('Traders/AvailableLinks', ['available_links' => $available_links, 'trader' => $trader]);
    }

    /**
     * Display a listing of the tradeable links.
     *
     * @return \Illuminate\Http\Response
     */
    public function tradeableLinks()
    {
        $trader = Account::where('user_id', Auth::user()->id)->first();
        $tradeables = TradersLink::where('user_id', Auth::user()->id)->get();
        return Inertia::render('Traders/TradeableLinks', ['trader' => $trader, 'tradeables' => $tradeables]);
    }

    /**
     * Display a listing of the trading section .
     *
     * @return \Illuminate\Http\Response
     */
    public function tradingSection()
    {
        $link = Link::where('status', ['active', 'in-active'])->first();
        $trader = Account::where('user_id', Auth::user()->id)->first();
        $trading_links = TradersLink::where('status', 'active')->orderBy('created_at', 'desc')->get();
        
        return Inertia::render('Traders/TradingSection', ['link' => $link, 'trader' => $trader, 'trading_links' => $trading_links]);
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
