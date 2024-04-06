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
        $products30 = Product::withoutGlobalScope('store')->with('category')->where('type', '30ml')->active()->limit(11)->get();
        $products60 = Product::withoutGlobalScope('store')->with('category')->where('type', '60ml')->active()->limit(11)->get();
        $products100 = Product::withoutGlobalScope('store')->with('category')->where('type', '100ml')->active()->limit(11)->get();

        return view('front.home', compact('products30', 'products60', 'products100'));
    }
    public function products(Request $request)
    {
        $products = Product::with('category')->filter($request->query())->latest()->paginate();
        return view('front.products.index', compact('products'));
    }
}
