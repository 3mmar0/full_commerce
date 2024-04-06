@extends('admin.layouts.sidebar')

@section('ttl', 'Products - Edit')

@section('page_name', 'Products')
@section('bread')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    <form class="p-4 m-4 border rounded-md" method="post" action="{{ route('dashboard.products.update', $product->id) }}"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <x-form.input name="name:en" value="{{ $product->name }}" label="product name (en)" type="text" />
        <x-form.input name="name:ar" value="{{ $product->translate('ar')->name }}" label="product name (ar)"
            type="text" />
        <x-form.text name="disc:en" value="{{ $product->disc }}" label="product disc (en)" />
        <x-form.text name="disc:ar" value="{{ $product->translate('ar')->disc }}" label="product disc (ar)" />
        {{-- <x-form.select name="category_id" :options="$cats" selected="{{ $product->category_id }}"
                label="product category" /> --}}

        <div class="form-group ">
            <label for="category_id">product category</label>
            <select name="category_id" id="category_id" class="form-control form-select">
                @foreach ($cats as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <x-form.input type="number" value="{{ $product->price }}" name="price:en" label="product price (en)" />
        <x-form.input type="number" value="{{ $product->translate('ar')->price }}" name="price:ar"
            label="product price (ar)" />
        <x-form.input type="number" value="{{ $product->compare_price }}" name="compare_price:en"
            label="product compare_price (en)" />
        <x-form.input type="number" value="{{ $product->translate('ar')->compare_price }}" name="compare_price:ar"
            label="product compare_price (ar)" />
        {{-- <x-form.input name="store" value="{{ $product->store->name }}" label="product store"
            disabled="{{ true }}" /> --}}
        <div>
            <x-form.input name="img" label="product image" type="file" accept="image/*" />

            @if ($product->image)
                <img width="100" height="100" style="object-fit:contain"
                    src="{{ asset('storage/' . $product->image) }}" alt="">
            @endif
        </div>
        <div class="form-group">
            <label for="">Type</label>
            <div class="flex gap-4">
                <x-form.radio name="type" checked="{{ $product->type }}" :options="[
                    '30ml' => '30ml',
                    '60ml' => '60ml',
                    '100ml' => '100ml',
                ]" />
            </div>
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <div class="flex gap-4">
                <x-form.radio name="status" checked="{{ $product->status }}" :options="[
                    'active' => 'Active',
                    'disactive' => 'Disactive',
                    'draft' => 'Draft',
                ]" />
            </div>
        </div>
        <x-form.input name="tags" label="product tags" value="{{ $tags }}" />
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
