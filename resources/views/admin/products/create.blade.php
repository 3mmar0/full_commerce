@extends('admin.layouts.sidebar')

@section('ttl', 'Products - Create')

@section('page_name', 'Products')
@section('bread')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

    <form class="p-4 m-4 border rounded-md" method="post" action="{{ route('dashboard.products.store') }}"
        enctype="multipart/form-data">
        @csrf
        @method('post')
        <x-form.input name="name:en" label="product name (en)" type="text" />
        <x-form.input name="name:ar" label="product name (ar)" type="text" />
        <x-form.text name="disc:en" label="product disc (en)" />
        <x-form.text name="disc:ar" label="product disc (ar)" />

        <div class="form-group ">
            <label for="category_id">product category</label>
            <select name="category_id" id="category_id" class="form-control form-select">
                @foreach ($cats as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <x-form.input type="number" name="price:en" label="product price (en)" />
        <x-form.input type="number" name="price:ar" label="product price (ar)" />
        <x-form.input type="number" name="compare_price:en" label="product compare_price (en)" />
        <x-form.input type="number" name="compare_price:ar" label="product compare_price (ar)" />
        <div>
            <x-form.input name="img" label="product image" type="file" accept="image/*" />
        </div>
        <div class="form-group">
            <label for="">Type</label>
            <div class="flex gap-4">
                <x-form.radio name="type" :options="[
                    '30ml' => '30ml',
                    '60ml' => '60ml',
                    '100ml' => '100ml',
                ]" />
            </div>
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <div class="flex gap-4">
                <x-form.radio name="status" :options="[
                    'active' => 'Active',
                    'disactive' => 'Disactive',
                    'draft' => 'Draft',
                ]" />
            </div>
        </div>
        <x-form.input name="tags" label="product tags" />
        <div class="form-group">
            <button type="submit" class="btn w-full btn-outline-primary">Update</button>
        </div>
    </form>
    @push('scripts')
        <script src="https://unpkg.com/@yaireo/tagify"></script>
        <script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
        <script>
            var inputElm = document.querySelector('[name=tags]'),
                tagify = new Tagify(inputElm);
        </script>
    @endpush
    @push('styles')
        <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    @endpush
@endsection
