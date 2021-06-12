<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    use HasFactory, CrudTrait;


    public function cart()
    {
        return $this->belongsToMany(Cart::class)->withTimestamps();
    }


}
