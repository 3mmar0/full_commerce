<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::withoutGlobalScope('store')->with('category')->active()->limit(8)->get();

        return view('front.home', compact('products'));
    }
    public function products(Request $request)
    {
        $products = Product::with('category')->filter($request->query())->latest()->paginate();
        return view('front.products.index', compact('products'));
    }
}
