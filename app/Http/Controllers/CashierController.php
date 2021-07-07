<?php

namespace App\Http\Controllers;

use App\Events\CashierCheckoutEvent;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function getSummary(Request $request)
    {

        $user = User::findOrFail($request->customer_id);

        return response()->json([
            'customer' => $user,
            'items' => Cart::getFormattedProducts($user->carts),
            'total' => Cart::getAllCartsTotal($user->carts),
        ]);

    }

    public function checkoutCustomer(Request $request)
    {

        $user = User::findOrFail($request->customer_id);

        $user->completePurchase('cashier', $request->user()->id);

        return back(303)->with('success', 'Checkout successful! Wish ' . $user->name . ' a good day.');

    }

    public function cashierCheckoutEvent(Request $request)
    {

        event(new CashierCheckoutEvent($request->user()->id, $request->cashier_id));

        return response('Cashier notified.');
    }
}
