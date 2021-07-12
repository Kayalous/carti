<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    public function apiGetFormattedUserPurchases(Request $request)
    {
        $newPurchases = \App\Models\Purchase::getFormattedPurchases(
            \App\Models\Purchase::where('user_id', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->groupBy('transaction_id')
        );

        return response()->json(
            $newPurchases
        );
    }

}
