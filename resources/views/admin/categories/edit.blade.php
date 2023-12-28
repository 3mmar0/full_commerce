@extends('admin.layouts.sidebar')

@section('ttl', 'Categories - Edit')

@section('page_name', 'Categories')
@section('bread')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    <form class="p-4 m-4 border rounded-md" method="post" action="{{ route('dashboard.categories.update', $cat->id) }}"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <x-form.input name="name" value="{{ $cat->name }}" label="Category name" type="text" />
        <x-form.text name="disc" value="{{ $cat->disc }}" label="Category disc" />

        <div class="form-group ">
            <label for="parent_id">Category parent</label>
            <select name="parent_id" id="parent_id" class="form-control form select">
                <option value="">Main Category</option>
                @foreach ($cats as $parent)
                    <option value="{{ $parent->id }}" @selected(old('parent_id', $cat->parent_id) == $parent->id)>{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <x-form.input name="img" label="Category image" type="file" accept="image/*" />

            @if ($cat->img)
                <img width="100" height="100" style="object-fit:contain" src="{{ asset('storage/' . $cat->img) }}"
                    alt="">
            @endif
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <div class="flex gap-4">
                <x-form.radio name="status" checked="{{ $cat->status }}" :options="[
                    'active' => 'Active',
                    'disactive' => 'Disactive',
                ]" />
            </div>
        </div>
        <div class="form-group">

            <button type="submit" class="btn w-full btn-outline-primary">Update</button>
        </div>
    </form>

@endsection
