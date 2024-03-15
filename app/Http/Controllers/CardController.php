<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    //
    function getCard(Request $request){
        $cardId = $request->json()->all()[0];

        $userCard = Card::find($cardId);
        return response()->json(['response' => $userCard]);
    }
}
