<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\BitcoinPayment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Link;
use App\Models\TradersLink;
use App\Models\TradersPayment;
use App\Models\User;
use Carbon\Carbon;
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
        $total_links = TradersLink::where('user_id', Auth::user()->id)->count();
        return Inertia::render('Traders/Dashboard', ['total_links' => $total_links]);
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
        $tradeables = TradersLink::where('user_id', Auth::user()->id)->where('status', 'active')->get();
        return Inertia::render('Traders/TradeableLinks', ['trader' => $trader, 'tradeables' => $tradeables]);
    }

    /**
     * Display a listing of the trading section .
     *
     * @return \Illuminate\Http\Response
     */
    public function tradingSection()
    {
        $trader = Account::where('user_id', Auth::user()->id)->first();

        if(Link::where('status', ['active', 'in-active'])->doesntExist()){
            return back()->with('warning', 'No Link available presently!');
        }

        $link = Link::where('status', ['active', 'in-active'])->first();
        $expiry_date = new Carbon($link->created_at->addHours($link->total_hours));
        if(Carbon::now() > $expiry_date){
            Link::where('id', $link->id)->update([
                'status' => 'expired'
            ]);
            while(TradersLink::where('link_id', $link->id)->where('status', 'active')->exists()){
                TradersLink::where('link_id', $link->id)->where('status', 'active')->update([
                    'status' => 'in-active'
                ]);
            }
        }
        
        // if(TradersLink::where(''))
        $trading_links = TradersLink::where('link_id', $link->id)->where('status', 'active')->orderBy('created_at', 'desc')->get();
        
        return Inertia::render('Traders/TradingSection', ['link' => $link, 'trader' => $trader, 'trading_links' => $trading_links]);
    }

    /**
     * Display a listing of the profile, account information.
     *
     * @return \Illuminate\Http\Response
     */
    public function accountInformation()
    {
        $user = User::where('id', Auth::user()->id)->with('referral')->first();
        return Inertia::render('Traders/AccountInformation', ['user' => $user]);
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
