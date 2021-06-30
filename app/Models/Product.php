<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    protected $guarded = [];
    use HasFactory, CrudTrait;
    use Searchable;


    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class)->withTimestamps();
    }

    public function purchasedBy()
    {
        return $this->belongsToMany(User::class, 'purchases')->withPivot(['qty', 'price'])->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function searchableAs()
    {
        return 'products_index';
    }


}
