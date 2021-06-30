<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentIntent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Product to update attach record, data from multiple carts.
    private function getProductsForAttach($carts)
    {
        $items = [];

        foreach ($carts as $cart) {
            foreach ($cart->products as $product) {
                $items[$product->id] = ['qty' => $product->pivot->qty, 'price' => $product->price];
            }
        }

        return $items;
    }


    public function completePurchase()
    {
        $user = $this->user;

        //Add items to user's purchase history
        $user->purchases()->attach($this->getProductsForAttach($user->carts));

        //Zero user's carts
        Cart::zeroCarts($user->carts);

        //De-sync all carts from user
        //Not sure if I should do this or not
//        $user->carts()->sync([]);
    }
}
