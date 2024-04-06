<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\ProductTrans;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{

    public function jsonData(Request $json)
    {
        // app()->setLocale('ar');
        // $locale = app()->getLocale();
        // dd(app()->getLocale());
        $data = $json->all();
        foreach ($data as $value) {
            // dd($value);
            // $value['locale'] = $locale;
            Product::create($value);
        }
    }
    public function jsonData2(Request $json)
    {
        // app()->setLocale('ar');
        // $locale = app()->getLocale();
        // dd(app()->getLocale());
        $data = $json->all();
        foreach ($data as $value) {
            // dd($value);
            // $value['locale'] = $locale;
            ProductTrans::create($value);
        }
    }
}
