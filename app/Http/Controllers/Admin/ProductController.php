<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use UploadImageTrait;

    public function index(Request $request)
    {

        $products = Product::paginate();
        return view('admin.products.index', compact('products'));
    }
}
