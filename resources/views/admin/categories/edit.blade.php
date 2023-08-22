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
        <div class="form-group ">
            <label for="name">Category name</label>
            <input type="text" value="{{ $cat->name }}" name="name" id="name" class="form-control">
        </div>
        <div class="form-group ">
            <label for="disc">Category Disc</label>
            <textarea type="text" name="disc" id="disc" class="form-control">{{ $cat->disc }}</textarea>
        </div>
        <div class="form-group ">
            <label for="parent_id">Category parent</label>
            <select name="parent_id" id="parent_id" class="form-control form select">
                <option value="">Main Category</option>
                @foreach ($cats as $parent)
                    <option value="{{ $parent->id }}" @selected($cat->parent_id == $parent->id)>{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group ">
            <label for="img">Image</label>
            <input type="file" name="img" id="img" class="form-control">
            @if ($cat->img)
                <img width="100" height="100" style="object-fit:contain" src="{{ asset('storage/' . $cat->img) }}"
                    alt="">
            @endif
        </div>
        <div class="form-group">
            <label for="">Status</label>
            <div class="flex gap-4">
                <div class="form-check">
                    <input type="radio" id="active" value="active" name="status" class="form-check-input"
                        @checked($cat->status == 'active')>
                    <label for="active" class="form-check-label">Active</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="disactive" value="disactive" name="status" class="form-check-input"
                        @checked($cat->status == 'disactive')>
                    <label for="disactive" class="form-check-label">Disactive</label>
                </div>
            </div>
        </div>
        <div class="form-group">

            <button type="submit" class="btn w-full btn-outline-primary">Update</button>
        </div>
    </form>

@endsection
