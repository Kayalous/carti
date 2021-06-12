<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProductToCart(Request $request)
    {
        $cart = Cart::findOrFail($cart_id);

        $product = Product::findOrFail($product_id);

        $cart->add($product);

        dd($cart->products->toJson());
    }

    public function removeProductFromCart(Request $request)
    {
        $cart = Cart::findOrFail($cart_id);

        $product = Product::findOrFail($product_id);

        $cart->remove($product);

        dd($cart->products->toJson());
    }

    public function getSummary(Request $request)
    {
        $user = $request->user();

        $carts = $user->carts;

        return Cart::getFormattedProducts($carts)
    }

    public function total(Request $request)
    {
        $cart = Cart::find($cart_id);
        dd(collect(['subtotal' => $cart->products->sum('price')])->toJson());
    }

}
