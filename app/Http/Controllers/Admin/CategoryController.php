<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use UploadImageTrait;

    public function index(Request $request)
    {

        $cats = Category::with('parent')->withCount('products')->filter($request->query())->paginate();
        return view('admin.categories.index', compact('cats'));
    }
    public function show($id)
    {
        $cat = Category::findorfail($id);
    }
    public function create()
    {
        $parents = Category::all();
        return view('admin.categories.create', compact('parents'));
    }
    public function store(Request $request)
    {
        $request->validate(Category::rules());
        $slug = Str::slug($request->post('name'));
        $img = $this->uploadImg($request, 'cats', 'img');
        Category::create([
            'parent_id' => $request->post('parent_id'),
            'name' => $request->post('name'),
            'slug' => $slug,
            'disc' => $request->post('disc'),
            'img' => $img,
            'status' => $request->post('status'),
        ]);

        return redirect()->route('dashboard.categories.index')->with(
            'success',
            'Category created'
        );
    }
    public function edit($id)
    {
        $cat = Category::findorfail($id);
        $cats = Category::where('id', '<>', $id)->get();

        return view('admin.categories.edit', compact('cat', 'cats'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(Category::rules($id));
        $cat = Category::findorfail($id);
        $slug = Str::slug($request->post('name'));
        $old_path = $cat->img;
        $path = $this->uploadImg($request, 'cats', 'img');
        $cat->update([
            'parent_id' => $request->post('parent_id'),
            'name' => $request->post('name') ?? $cat->name,
            'slug' => $slug,
            'disc' => $request->post('disc') ?? $cat->disc,
            'img' => $path ?? $cat->img,
            'status' => $request->post('status') ?? $cat->status,
        ]);

        if ($old_path && isset($path)) {
            Storage::disk('public')->delete($old_path);
        }

        return redirect()->route('dashboard.categories.index')->with(
            'success',
            'Category updated'
        );
    }
    public function destroy($id)
    {
        $cat = Category::findorfail($id);
        $cat->forceDelete();

        if ($cat->img) {
            Storage::disk('public')->delete($cat->img);
        }

        return redirect()->route('dashboard.categories.index')->with(
            'success',
            'Category moved to trash'
        );
    }
}
