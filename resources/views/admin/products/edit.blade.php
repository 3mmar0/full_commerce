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
        <x-form.input name="name" value="{{ $product->name }}" label="product name" type="text" />
        <x-form.text name="disc" value="{{ $product->disc }}" label="product disc" />
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
        <x-form.input type="number" name="price" value="{{ $product->price }}" label="product price" />
        <x-form.input type="number" name="compare_price" value="{{ $product->compare_price }}"
            label="product compare_price" />
        <x-form.input name="store" value="{{ $product->store->name }}" label="product store"
            disabled="{{ true }}" />
        <div>
            <x-form.input name="img``````````````````````````````````````````````````````````````````````"
                label="product image" type="file" accept="image/*" />

            @if ($product->image)
                <img width="100" height="100" style="object-fit:contain"
                    src="{{ asset('storage/' . $product->image) }}" alt="">
            @endif
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
