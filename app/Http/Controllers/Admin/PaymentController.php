<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Braintree\Gateway;
use Braintree\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function make(Request $request)
    {
        if (!$request->has('payload')) {
            return response()->json(['error' => 'Payload non presente nella richiesta.'], 400);
        }
        $payload = $request->input('payload');

        if (!isset($payload['nonce'])) {
            return response()->json(['error' => 'Nonce non presente nel payload.'], 400);
        }

        $nonce = $payload['nonce'];
        $status = Transaction::sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
        return response()->json($status);
    }
}
