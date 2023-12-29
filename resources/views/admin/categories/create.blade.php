@extends('admin.layouts.sidebar')

@section('ttl', 'Categories - create')

@section('page_name', 'Categories')
@section('bread')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

    <form class="p-4 m-4 border rounded-md" action="{{ route('dashboard.categories.store') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <x-form.input name="name" label="Category name" type="text" />
        <x-form.text name="disc" label="Category disc" />

        <div class="form-group ">
            <label for="parent_id">Category parent</label>
            <select name="parent_id" id="parent_id" class="form-control form select">
                <option value="">Main Category</option>
                @foreach ($parents as $cat)
                    <option value="{{ $cat->id }}" @selected(old('parent_id') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <x-form.input name="img" label="Category image" type="file" accept="image/*" />

        <div class="form-group">
            <label for="">Status</label>
            <div class="flex gap-4">
                <x-form.radio name="status" :options="[
                    'active' => 'Active',
                    'disactive' => 'Disactive',
                ]" />
            </div>
        </div>
        <div class="form-group">

            <button type="submit" class="btn w-full btn-outline-primary">create</button>
        </div>
    </form>

@endsection
