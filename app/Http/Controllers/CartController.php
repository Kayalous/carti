<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{

    public function show(Request $request)
    {
        return Inertia::render('UserCart', [
            'items' => Cart::getFormattedProducts(Auth::user()->carts),
            'total' => Cart::getAllCartsTotal(Auth::user()->carts)
        ]);
    }

    public function addProductToCart(Request $request)
    {

        $product = $request->user()->carts[0]->add($request->product_id, $request->qty);
        if ($product)
            $msg = 'Added ' . $product->name . ', currently ' . $product->pivot->qty . ' in cart.';
        else
            $msg = 'Added to cart.';

        return back(303)->with('success', $msg);

    }

    public function removeProductFromCart(Request $request)
    {

        $product = $request->user()->carts[0]->remove($request->product_id, $request->qty);

        if ($product)
            $msg = 'Removed ' . $product->name . ' from cart, currently ' . $product->pivot->qty . ' pcs in cart.';
        else
            $msg = 'Removed product from cart.';

        return back(303)->with('success', $msg);

    }


}
