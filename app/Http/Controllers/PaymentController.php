<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    
    public function processPayment($value, $rediUrl) {
        $id = "300746";

        $rul = "";
        if ($rediUrl) 
            $rul = "http://127.0.0.1:8000/en/getFormularzMiasto";
        else 
            $rul = "http://127.0.0.1:8000/en/getFormularzRodzina";
    
        $response1 = Http::asForm()->post('https://secure.snd.payu.com/pl/standard/user/oauth/authorize', [
            'grant_type' => 'client_credentials',
            'client_id' => $id,
            'client_secret' => '2ee86a66e5d97e3fadc400c9f19b065d'
        ]);
        $access_token = $response1['access_token'];
        // echo $access_token;
    
    
        // echo $access_token;
        // sleep(5);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$access_token,
        ])->post('https://secure.snd.payu.com/api/v2_1/orders', [
            'notifyUrl' => 'http://127.0.0.1:8000/en/getFormularzMiasto',
            'continueUrl' => $rul,
            'customerIp' => '127.0.0.1',
            'merchantPosId' => '300746',
            'description' => 'RTV market',
            'currencyCode' => 'PLN',
            'totalAmount' => $value,
            'products' => [
                [
                    'name' => 'Wireless Mouse for Laptop',
                    'unitPrice' => '199',
                    'quantity' => '1'
                ]
            ]
        ]);
        
        $transferStats = $response->transferStats;
        $request = $transferStats->getRequest();
    
        // print_r($request);
        $url = $request->getUri()->__toString();
    
        // print_r($url);
        // echo $url;
    
        return redirect($url); 
    }
}
