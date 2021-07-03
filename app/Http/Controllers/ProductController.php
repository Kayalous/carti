<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{


    public function showAllProducts(Request $request)
    {

        $minPrice = Product::all()->sortBy("price")->first()->price;

        $maxPrice = Product::all()->sortByDesc("price")->first()->price;

        $filters = (object)[
            'q' => (strlen($request->q) > 0) ? $request->q : '',
            'orderBy' => $request->orderBy ? $request->orderBy : 'desc',
            'min' => $request->min ? $request->min : 0,
            'max' => $request->max ? $request->max : $maxPrice
        ];


        if (strlen($request->q) > 0) {

            $ids = Product::search($request->q)->get()->pluck('id');

            $products = Product::whereIn('id', $ids)->orderBy('price', $filters->orderBy)->where('price', '>=', $filters->min)->where('price', '<', ($filters->max + 1))->paginate(12);

        } else
            $products = Product::orderBy('price', $filters->orderBy)->where('price', '>=', $filters->min)->where('price', '<', ($filters->max + 1))->paginate(12);


        if ($request->require_json)
            return response()->json([
                'items' => $products,
            ]);

        return Inertia::render('AllProducts', [
            'dbProducts' => $products,
            'filters' => $filters,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);

    }

    public function show($product_id){
        return Inertia::render('Product', [
            'product' => Product::findOrFail($product_id)
        ]
        );
    }

    public function showCreate()
    {
        return Inertia::render('AddProduct');
    }

    public function create(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:5000',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $path = '';

        if ($request->hasFile('image')) {

            $path = '/' . $request->file('image')->store('public/images');

            $path = '/storage/images/' . explode('/', $path)[3];


        } else {
            $path = '/images/icon-product-5.jpg';
        }

        $product = $request->except(['image']);
        $product['image'] = $path;


        $request->user()->inventory()->create($product);

        return back(303)->with('success', 'Product added.');

    }

    public function showUpdate(Request $request, $product_id)
    {
        return Inertia::render('EditProduct', ['product' => $request->user()->inventory()->findOrFail($product_id)]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'max:255',
            'description' => 'max:5000',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $product = $request->user()->inventory()->findOrFail($request->id);

        $path = $product->image;

        $newProduct = $request->all();

        if ($request->hasFile('image')) {

            $path = '/' . $request->file('image')->store('public/images');
            $path = '/storage/images/' . explode('/', $path)[3];

            $newProduct['image'] = $path;
        }

        $product->fill($newProduct);

        $product->save();

        return back(303)->with('success', 'Changes saved.');
    }

    public function destroy(Request $request)
    {

        $request->user()->inventory()->findOrFail($request->product_id)->delete();

        $request->session()->flash('flash.banner', 'Product deleted successfully.');

        $request->session()->flash('flash.bannerStyle', 'success');

        $request->session()->reflash();

        return redirect('/dashboard', 303);

    }

    public function productFromBarcode(Request $request)
    {
        $product = Product::where('barcode', $request->barcode)->first();
        if ($product)
            return response()->json([
                'product' => $product,
            ]);
        else
            return response('Product not found', 404);
    }
}
