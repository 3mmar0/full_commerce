@extends('admin.layouts.sidebar')

@section('ttl', 'Categories')

@section('page_name', 'Categories')
@section('bread')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

    <a class="my-4 mx-3 right block btn btn-success" href="{{ route('dashboard.categories.create') }}">
        create
    </a>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Img</th>
                <th>Name</th>
                <th>Parent_id</th>
                <th>Created_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cats as $cat)
                <tr>
                    <td>{{ $cat->id ?? '' }}</td>
                    <td>
                        <img width="50" height="50" style="object-fit:contain" src="{{ asset('storage/' . $cat->img) }}"
                            alt="">
                    </td>
                    <td>{{ $cat->name ?? '' }}</td>
                    <td>{{ $cat->parent_id ?? 'main' }}</td>
                    <td>{{ $cat->created_at ?? '' }}</td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('dashboard.categories.edit', $cat->id) }}"
                                class="mr-2 btn btn-sm btn-outline-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('dashboard.categories.destroy', $cat->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center text-md font-semibold bg-gray" colspan="6">No Categories yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
