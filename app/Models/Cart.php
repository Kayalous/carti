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



    public function user()
    {
        return $this->belongsTo(User::class)->withTimestamps();
    }

    public function add(Product $product)
    {
        $carted = $this->products()->find($product);
        if ($carted) {
            $carted->pivot->increment('qty');
            $carted->save();
        } else
            $this->products()->attach($product);


        return $this;
    }

    public function remove(Product $product)
    {
        $carted = $this->products()->find($product);
        if ($carted?->pivot?->qty > 1) {
            $carted->pivot->decrement('qty');
            $carted->save();
        } else
            $this->products()->detach($product);

        return $this;
    }

    public function total()
    {
        return $this->products->sum('price');
    }

    public static function getFormattedProducts($carts){
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

}
