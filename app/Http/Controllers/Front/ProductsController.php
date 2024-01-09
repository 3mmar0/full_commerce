<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\ProductTranslation;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::paginate();

        return view('front.products.index', compact('products'));
    }

    public function show($slug)
    {
        $product_trans = ProductTranslation::where('slug', $slug)->first();
        $product = Product::where('id', $product_trans->product_id)->first();
        // dd($product);
        if ($product->status != 'active') {
            abort(404);
        }

        return view('front.products.show', compact('product'));
    }
}
