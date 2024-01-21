@extends('admin.layouts.sidebar')

@section('ttl', 'Categories')

@section('page_name', 'Categories')
@section('bread')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

    <x-alert type="success" />

    <a class="my-4 mx-3 right block btn btn-success" href="{{ route('dashboard.categories.create') }}">
        create
    </a>

    <form class="rounded mx-3 mb-4" action="{{ URL::current() }}" method="get">
        <x-form.input name="name" placeholder="Search...." type="search" :value="request('name')" />
        <select name="status" class="form-control">
            <option value="">All</option>
            <option @selected(request('status') == 'active') value="active">Active</option>
            <option @selected(request('status') == 'disactive') value="disactive">Disactive</option>
        </select>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Img</th>
                <th>Name</th>
                <th>Parent_id</th>
                <th>#Products</th>
                <th>Status</th>
                <th>Created_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cats as $cat)
                <tr>
                    <td>{{ $cat->id ?? '' }}</td>
                    <td>
                        <img width="50" height="50" style="object-fit:contain" src="{{ $cat->image_url }}"
                            alt="">
                    </td>
                    <td>{{ $cat->name ?? '' }}</td>
                    <td>{{ $cat->parent->name }}</td>
                    <td>{{ $cat->products_count }}</td>
                    <td>{{ $cat->status ?? '' }}</td>
                    <td>{{ $cat->created_at ?? '' }}</td>
                    <td>
                        <div class="flex gap-2">
                            @can('categories.update')
                                <a href="{{ route('dashboard.categories.edit', $cat->id) }}"
                                    class="mr-2 btn btn-sm btn-outline-success">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan
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
                    <td class="text-center text-md font-semibold bg-gray" colspan="8">No Categories yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $cats->withQueryString()->links() }}

@endsection
