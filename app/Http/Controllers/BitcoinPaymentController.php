<?php

namespace App\Http\Controllers;

use App\Models\BitcoinPayment;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BitcoinPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $client = new Client();
        $response = $client->get('https://www.blockonomics.co/api/merchant_order/'.$addr, [
            'headers' => ['Authorization' => 'Bearer ']
        ]);

        if($status != 2) {
            return;
        }

        $bitcoinPayment = new BitcoinPayment();

        $bitcoinPayment->txid = $txid;
        $bitcoinPayment->value = $value;
        $bitcoinPayment->status = $status;
        $bitcoinPayment->address = $addr;

        $bitcoinPayment->save();

        return json_encode(['status' => 200]);
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
    public function update(Request $request, BitcoinPayment $bitcoinPayment)
    {
        //
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
