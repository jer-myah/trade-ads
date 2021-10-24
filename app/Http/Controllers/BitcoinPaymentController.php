<?php

namespace App\Http\Controllers;

use App\Models\BitcoinPayment;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Throwable;
use App\Models\Account;
use App\Models\User;

class BitcoinPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bitcoinPayments = BitcoinPayment::get();
        return Inertia::render('Admin/Payments/FundAccount', ['bitcoinPayments' => $bitcoinPayments]);
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
        $secret = env('BLOCKONOMICS_SECRET');
        $txid = $request->txid;
        $value = $request->value;
        $status = $request->status;
        $addr = $request->addr;

        if(BitcoinPayment::where('address', $addr)->exists()){
            BitcoinPayment::where('address', $addr)->update([
                'status' => $status
            ]);
            if($status == 2){
                return response()->json(['success' => 'success', 200]);
            }
            return response()->json(204);
        }

        $client = new Client();
        $response = $client->get('https://www.blockonomics.co/api/merchant_order/'.$addr, [
            'headers' => ['Authorization' => 'Bearer YGHuWZXiVTIagg0k7DKTB9wpgxHyd8Fhrp01iYfM40c']
        ]);

        $data = json_decode($response->getBody());

        $bitcoinPayment = new BitcoinPayment();
        
        $bitcoinPayment->email = $data->email;
        $bitcoinPayment->txid = $txid;
        $bitcoinPayment->value = $value;
        $bitcoinPayment->status = $status;
        $bitcoinPayment->address = $addr;

        $bitcoinPayment->save();
        
        if($status == 2){
            return response()->json(['success' => 'success', 200]);
        }
        return response()->json(204);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BitcoinPayment  $bitcoinPayment
     * @return \Illuminate\Http\Response
     */
    public function show(BitcoinPayment $bitcoinPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BitcoinPayment  $bitcoinPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(BitcoinPayment $bitcoinPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BitcoinPayment  $bitcoinPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try{
            $bitcoin = BitcoinPayment::where('id', $id)->first();
            if(User::where('email', $bitcoin->email)->doesntExist()){
                return back()->with('message', 'No user found with this email! 😎');
            }
            $user = User::where('email', $bitcoin->email)->first();
            if(Account::where('user_id', $user->id)->doesntExist()){                
                Account::create([
                    'user_id' => $user->id,
                    'main_balance' => 0.00,
                    'trading_balance' => 0.00, 
                ]);
            }

            Account::where('user_id', $id)->update([
                'main_balance' => $bitcoin->value
            ]);
            
            BitcoinPayment::where('id', $id)->update([
                'credited' => true,
            ]);

            return back()->with('message', 'User Account was credited Successfully! 👌');
        
        } catch(Throwable $e) {
            report($e);

            return false;
        }
        

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BitcoinPayment  $bitcoinPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(BitcoinPayment $bitcoinPayment)
    {
        //
    }
}
