<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Tag;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use UploadImageTrait;

    public function index(Request $request)
    {
        $products = Product::with(['category', 'store'])->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function edit($id)
    {
        $product = Product::findorfail($id);
        $cats = Category::all();
        $tags = implode(',', $product->tags()->pluck('name')->toArray());

        return view('admin.products.edit', compact('product', 'cats', 'tags'));
    }

    public function update(Request $request, $id)
    {
        // $request->validate(Product::rules($id));
        $product = Product::findorfail($id);
        $slug = Str::slug($request->post('name'));
        $old_path = $product->image;
        $path = $this->uploadImg($request, 'products', 'img');
        $request->merge([
            'slug' => $slug,
            'image' => $path,
        ]);
        $product->update($request->except('tags'));

        $tags = json_decode($request->post('tags'));
        $tag_ids = [];

        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = Tag::where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);

        if ($old_path && isset($path)) {
            Storage::disk('public')->delete($old_path);
        }

        return redirect()->route('dashboard.products.index')->with(
            'success',
            'Product updated'
        );
    }
}
