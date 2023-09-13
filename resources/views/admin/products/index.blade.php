@extends('admin.layouts.sidebar')

@section('ttl', 'Products')

@section('page_name', 'Products')
@section('bread')
    @parent
    <li class="breadcrumb-item active">Products</li>
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
                <th>Category</th>
                <th>Store</th>
                <th>Status</th>
                <th>Created_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id ?? '' }}</td>
                    <td>
                        <img width="50" height="50" style="object-fit:contain" src="{{ $product->image }}"
                            alt="">
                    </td>
                    <td>{{ $product->name ?? '' }}</td>
                    <td>{{ $product->category->name ?? '' }}</td>
                    <td>{{ $product->store->name ?? '' }}</td>
                    <td>{{ $product->status ?? '' }}</td>
                    <td>{{ $product->created_at ?? '' }}</td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                class="mr-2 btn btn-sm btn-outline-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post">
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
                    <td class="text-center text-md font-semibold bg-gray" colspan="8">No Products yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $products->withQueryString()->links() }}

@endsection
