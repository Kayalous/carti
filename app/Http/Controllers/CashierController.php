<?php

namespace App\Http\Controllers;

use App\Events\CashierCheckoutEvent;
use App\Models\Cart;
use App\Models\Product;
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

        return response()->json([
            'formSuccess' => 'Checkout successful! Wish ' . $user->name . ' a good day.'
        ]);

    }

    public function addItem(Request $request)
    {

        $user = User::findOrFail($request->customer_id);

        $item = Product::where('barcode', $request->barcode)->first();

        if(!$item)
            return response()->json(['formError' => 'No items matching the entered barcode']);

        $user->carts[0]->add($item->id, 1);

        return response()->json([
            'items' => Cart::getFormattedProducts($user->carts),
            'total' => Cart::getAllCartsTotal($user->carts),
            'formSuccess' => 'Added ' . $item->name . ' to cart.'
        ]);

    }

    public function removeItem(Request $request)
    {

        $user = User::findOrFail($request->customer_id);

        $item = $user->carts[0]->products()->find($request->product_id);

        if(!$item)
            return response()->json(['formError' => 'Item no longer in cart.']);

        $user->carts[0]->products()->detach($item->id);

        return response()->json([
            'items' => Cart::getFormattedProducts($user->carts),
            'total' => Cart::getAllCartsTotal($user->carts),
            'formSuccess' => 'Removed ' . $item->name . ' from cart.'
        ]);

    }

    public function editItem(Request $request)
    {

        $user = User::findOrFail($request->customer_id);

        $item = $user->carts[0]->products()->find($request->product_id);

        if(!$item)
            return response()->json(['formError' => 'Item no longer in cart.']);

        //Logic to check if the if the qty is 0, or more than what's currently in stock
        if($request->qty <= 0 || !$request->qty)
            $user->carts[0]->products()->detach($item->id);
        elseif ($request->qty >= $item->qty)
            $user->carts[0]->products()->updateExistingPivot($request->product_id, ['qty' => $item->qty]);
        else
        $user->carts[0]->products()->updateExistingPivot($request->product_id, ['qty' => $request->qty]);

        return response()->json([
            'items' => Cart::getFormattedProducts($user->carts),
            'total' => Cart::getAllCartsTotal($user->carts),
            'formSuccess' => 'Updated cart.'
        ]);

    }

    public function cashierCheckoutEvent(Request $request)
    {
        $user = User::find($request->cashier_id);

        if ($user?->hasRole('cashier')) {

            event(new CashierCheckoutEvent($request->user()->id, $request->cashier_id));

            return response('Cashier notified.');

        } else {

            return response('Not a valid cashier.', 405);

        }
    }
}
