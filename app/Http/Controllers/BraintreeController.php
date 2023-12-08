<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Braintree\Gateway;
use Illuminate\Http\Request;

class BraintreeController extends Controller
{
    public function token(Request $request)
    {
        session_start();
        // dd($_SESSION);
        $price = $_SESSION["price"];
        dd($price);
        $apartment_id = $_SESSION["apartment_id"];
        $sponsorship_id = $_SESSION["sponsorship_id"];


        // $apartment_id = $request->input('apartment-id');
        // $sponsorship_id = $request->input('sponsor-id');
        // $sponsorship_price = $request->input('sponsor-price');

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY"),
        ]);

        if ($request->input('nonce') != null) {
            $nonceFromTheClient = $request->input('nonce');

            $gateway->transaction()->sale([
                'amount' => $price,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True,
                ],
            ]);

            $apartment = Apartment::find($apartment_id);
            $apartment->sponsorships()->attach($sponsorship_id);
            return view('admin.braintree');
        } else {

            $clientToken = $gateway->clientToken()->generate();
            return view('admin.braintree', ['token' => $clientToken]);
        }
    }
}
