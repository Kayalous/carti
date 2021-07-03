<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;


    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty')->withTimestamps();
    }


//    public function update(array $attributes = [], array $options = [])
//    {
//
//        $products = json_decode($attributes['product']);
//
//        $newCart = [];
//        foreach ($products as $product) {
//            $tempCart = [$product->product_id => ['qty' => $product->{'pivot->qty'}]];
//            array_push($newCart, $tempCart);
//        }
//        $cart = $this->products()->sync($newCart);
//        dd($cart);
//
////        return $item;
//
//    }


    public function user()
    {
        return $this->belongsTo(User::class)->withTimestamps();
    }

    public function add($product_id, $qty = 1)
    {

        $carted = $this->products()->find($product_id);


        if ($carted) {
            $carted->pivot->qty += $qty;
            $this->products()->updateExistingPivot($product_id, ['qty' => $carted->pivot->qty]);
        } else
            $this->products()->attach([$product_id => ['qty' => $qty]]);


        return $carted;
    }

    public function remove($product_id, $qty = 1)
    {
        $carted = $this->products()->find($product_id);

        if ($carted?->pivot?->qty > 1 && $carted?->pivot?->qty > $qty) {
            $carted->pivot->qty -= $qty;
            $this->products()->updateExistingPivot($product_id, ['qty' => $carted->pivot->qty]);
        } else
            $this->products()->detach($product_id);


        return $carted;
    }

    public function total()
    {
        return $this->products->sum(function($item){
            return $item->price * $item->pivot->qty;
        });
    }

    public static function getAllCartsTotal($carts)
    {
        $total = 0;

        foreach ($carts as $cart) {
            $total += $cart->total();
        }

        return $total;
    }


    //Product data ready to be displayed anywhere, from multiple carts.
    public static function getFormattedProducts($carts)
    {
        $items = [];

        foreach ($carts as $cart)
            foreach ($cart->products as $product) {
                $item = [
                    'qty' => $product->pivot->qty,
                    'updated_at' => $product->pivot->updated_at
                ];
                $item = array_merge($product->makeHidden(['qty', 'created_at', 'updated_at', 'pivot'])->toArray(), $item);
                array_push($items, $item);
            }
        return $items;
    }

    public static function zeroCarts($carts)
    {
        foreach ($carts as $cart)
            $cart->products()->sync([]);

    }


}
