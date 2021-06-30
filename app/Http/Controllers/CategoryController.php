<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all()
    {

        return response()->json([
            'categories' => Category::all(),
        ]);

    }


    public function categoryProducts(Request $request)
    {

        $category = Category::find($request->category_id);
        if ($category)
            return response()->json([
                'products' => $category->products,
            ]);
        else
            return response('Category not found', 404);

    }
}
