<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function saveFormData(Request $request)
    {
        // Valida i dati del modulo
        $request->validate([
            'email' => 'required|email',
            'message' => 'required',
            'apartment_id' => 'required',
        ]);

        // Salva i dati nel database
        $message = new Message();
        $message->email = $request->input('email');
        $message->apartment_id = $request->input('apartment_id');
        $message->text = $request->input('message');
        $message->save();

        return response()->json(['message' => 'Dati salvati con successo'], 200);
    }
}
