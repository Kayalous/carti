<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getFormattedPurchases($purchases){

        $newPurchases = [];
        foreach ($purchases as $key=>$purchase){

            $items = $purchase->map(function ($item, $key){
                $product = $item->product;
                $product->price = $item->price;
                $product->qty = $item->qty;

                return $product;
            });

            $singlePurchase = [
                'transaction_id' => $key,
                'payment_method' => $purchase[0]->payment_method,
                'date' => $purchase[0]->created_at->format('d/m/Y h:i a'),
                'items' => $items->toArray(),
                'total' => $items->sum(function($item){
                    return $item->price * $item->qty;
                })
            ];
            array_push($newPurchases, $singlePurchase);
        }

        return $newPurchases;
    }
}
