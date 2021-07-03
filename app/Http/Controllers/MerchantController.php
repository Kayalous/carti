<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MerchantController extends Controller
{
    public function show(Request $request){
        return Inertia::render('MerchantInventory', ['products' => $request->user()->inventory()->orderBy('updated_at', 'desc')->get()]);
    }
}
