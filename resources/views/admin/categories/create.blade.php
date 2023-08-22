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
        <div class="form-group ">
            <label for="name">Category name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group ">
            <label for="disc">Category Disc</label>
            <textarea type="text" name="disc" id="disc" class="form-control"></textarea>
        </div>
        <div class="form-group ">
            <label for="parent_id">Category parent</label>
            <select name="parent_id" id="parent_id" class="form-control form select">
                <option value="">Main Category</option>
                @foreach ($parents as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group ">
            <label for="img">Image</label>
            <input type="file" name="img" id="img" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <div class="flex gap-4">
                <div class="form-check">
                    <input type="radio" id="active" value="active" name="status" class="form-check-input" checked>
                    <label for="active" class="form-check-label">Active</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="disactive" value="disactive" name="status" class="form-check-input">
                    <label for="disactive" class="form-check-label">Disactive</label>
                </div>
            </div>
        </div>
        <div class="form-group">

            <button type="submit" class="btn w-full btn-outline-primary">create</button>
        </div>
    </form>

@endsection
