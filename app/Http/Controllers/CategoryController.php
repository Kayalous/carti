<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all(){

        return response()->json([
            'categories' => Category::all(),
        ]);

    }

    public function categoryProducts(Request $request){

        return response()->json([
            'products' => Category::find($request->category_id)->products,
        ]);

    }
}
