<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Link;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PaymentToAdmin;
use App\Models\TradersLink;
use App\Models\TradersPayment;
use App\Models\UserReferred;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Link::count() == 0){ 
            return Inertia::render('Admin/Links/Index');
        }

        $links = Link::where('status', '!=', 'active')->with('advert')->get();

        $current_link = Link::where('status', 'active')->with('advert')->first();

        return Inertia::render('Admin/Links/Index', ['links' => $links, 'current_link' => $current_link]);
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
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function purchaseAdslink($link)
    { 
        if(Link::where('link', $link)->doesntExist()){
            return back()->with('warning', 'There seems to be an issue with this request...');
        }

        if(Link::where('link', $link)->where('status', 'expired')->exists()){
            return back()->with('warning', 'Ads Link has expired!');
        }

        // if(now()->diffInMinutes($link->duration) < 2){
        //     return back()->with('warning', 'Link seems to have expired!');
        // }
        
        $link = Link::where('link', $link)->first();

        // check if user has purchase from fellow trader
        if(TradersPayment::where(['buyer_id' => Auth::user()->id, 'link_id' => $link->id])->exists()){
            return back()->with('warning', 'You already made purchase from the trading section!');
        }
        
        $user_referred = UserReferred::where('user_id', Auth::user()->id)->first(); // counter must be greater than 20 for user to repurchase same link again
        $payment_count = PaymentToAdmin::where(['user_id' => Auth::user()->id, 'link_id' => $link->id])->count();
        
        
        // check if user had made payment for the particular link previously 
        // and also check if the referrals counter is up to 20
        if($user_referred->count < 20 && $payment_count == 1){
            return back()->with('warning', 'Oops!!! You cannot make another payment!');
        }


        // allow payment if referral counter is 20 and over 
        // also the previous link is no longer acitve
        // and previous payment not more than 2 
        
        if($user_referred->count >= 20 && $payment_count == 1 ){
            if(TradersLink::where(['link_id' => $link->link_id, 'status' => 'in-active'])->exists()){
                
                $user_account = Account::where('user_id', Auth::user()->id)->first(); 
                if($user_account->main_balance >= $link->amount) {
                    
                    $payment = new PaymentToAdmin;
                    $payment->user_id = Auth::user()->id;
                    $payment->link_id = $link->id;
                    $payment->amount = $link->amount;
                    
                    $payment->save();
                    
                    Account::where('user_id', Auth::user()->id)->decrement('main_balance', $link->amount);
                    
                    // generate code for voluntary traders
                    
                    $traders_link = new TradersLink;

                    $traders_link->user_id = Auth::user()->id;
                    $traders_link->link_id = $link->id;
                    $traders_link->trader_link = Str::random(16);
                    $traders_link->num_sale = $link->voluntary_sale;
                    $traders_link->unit_sale = $link->voluntary_amount;
                    $traders_link->sale_count = 0;

                    $traders_link->save();

                    return back()->with('success', 'Payment was successful');
                }
            }
            
        }

        // first time payment
        $user_account = Account::where('user_id', Auth::user()->id)->first(); 
        
        if(($user_account->main_balance >= $link->amount) && ($payment_count == 0)) {
            
            $payment = new PaymentToAdmin;
            $payment->user_id = Auth::user()->id;
            $payment->link_id = $link->id;
            $payment->amount = $link->amount;
            
            $payment->save();
            
            $user_account = Account::where('user_id', Auth::user()->id)->first();
            
            // generate code/link for voluntary traders
            $traders_link = new TradersLink;
            
            $traders_link->user_id = Auth::user()->id;
            $traders_link->link_id = $link->id;
            $traders_link->trader_link = Str::random(16);
            $traders_link->num_sale = $link->voluntary_sale;
            $traders_link->unit_sale = $link->voluntary_amount;
            $traders_link->sale_count = 0;

            $traders_link->save();

            // update the trader's main account balance
            Account::where('user_id', Auth::user()->id)->decrement('main_balance', $link->amount);
            
            return back()->with('success', 'Payment was successful');
        } else{
            return back()->with('warning', 'You may have to wait for another link to be shared.');
        }     
        


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function share(Request $request)
    { 
        if($request->shared == 'both'){
            $request->top_amount = $request->vol_amount;
            $request->top_sale = $request->vol_sale;
        }

        if(empty($request->top_amount)){
            $request->top_amount = 0;
        }

        if(empty($request->top_sale)){
            $request->top_sale = 0;
        }

        Link::where('id', $request->id)->update([
            'shared_with' => $request->shared,
            'amount' => $request->amount,
            'top_amount' => $request->top_amount,
            'top_sale' => $request->top_sale,
            'voluntary_amount' => $request->vol_sale,
            'voluntary_sale' => $request->vol_sale,
        ]);

        return redirect('/admin/view-links')->with('success', 'Link has been shared!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        //
    }
}
