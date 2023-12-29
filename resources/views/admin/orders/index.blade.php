@extends('admin.layouts.sidebar')

@section('ttl', 'Orders')

@section('page_name', 'Orders')
@section('bread')
    @parent
    <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')

    <x-alert type="success" />

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
                <th>#Number</th>
                <th>From</th>
                <th>Payment Status</th>
                <th>Status</th>
                <th>Created_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id ?? '' }}</td>
                    <td>{{ $order->number ?? '' }}</td>
                    <td>{{ $order->user->name ?? '' }}</td>
                    <td>{{ $order->payment_status ?? '' }}</td>
                    <td>{{ $order->status ?? '' }}</td>
                    <td>{{ $order->created_at ?? '' }}</td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('dashboard.orders.edit', $order->id) }}"
                                class="mr-2 btn btn-sm btn-outline-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="post">
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
                    <td class="text-center text-md font-semibold bg-gray" colspan="8">No orders yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $orders->withQueryString()->links() }}

@endsection
