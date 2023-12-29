@extends('admin.layouts.sidebar')

@section('ttl', 'orders - Edit')

@section('page_name', 'orders')
@section('bread')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.orders.index') }}">orders</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    <form class="p-4 m-4 border rounded-md" method="post" action="{{ route('dashboard.orders.update', $order->id) }}"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <x-form.input name="number" value="{{ $order->number }}" label="order number" type="text" readonly />
        <x-form.input name="from" value="{{ $order->user->name }}" label="order from" readonly />
        <x-form.input type="text" name="payment_method" value="{{ $order->payment_method }}" label="order payment_method"
            readonly />
        {{-- <x-form.input type="text" name="total" value="{{ $order->total }}" label="order total" /> --}}
        {{-- <x-form.input name="store" value="{{ $order->store->name }}" label="order store"
            disabled="{{ true }}" /> --}}
        {{-- <div>
            <x-form.input name="img" label="order image" type="file" accept="image/*" />

            @if ($order->image)
                <img width="100" height="100" style="object-fit:contain"
                    src="{{ asset('storage/' . $order->image) }}" alt="">
            @endif
        </div> --}}
        <div class="form-group">
            <label for="">Status of Order</label>
            <div class="flex gap-4">
                <x-form.radio name="status" checked="{{ $order->status }}" :options="[
                    'pending' => 'pending',
                    'processing' => 'processing',
                    'delivering' => 'delivering',
                    'completed' => 'completed',
                    'cancelled' => 'cancelled',
                    'refunded' => 'refunded',
                ]" />
            </div>
        </div>
        <div class="form-group">
            <label for="">Payment Status</label>
            <div class="flex gap-4">
                <x-form.radio name="payment_status" checked="{{ $order->payment_status }}" :options="[
                    'pending' => 'pending',
                    'paid' => 'paid',
                    'failed' => 'failed',
                ]" />
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn w-full btn-outline-primary">Update</button>
        </div>
    </form>
    <section class="p-4 m-4 border rounded-md mt-4">
        <h2 class="text-xl text-bold text-center mb-3">Billing Address</h2>
        <div>
            <x-form.input value="{{ $billing_addr->first_name }}" label="Billing first_name" type="text" readonly />
            <x-form.input value="{{ $billing_addr->last_name }}" label="Billing last_name" type="text" readonly />
            <x-form.input value="{{ $billing_addr->email }}" label="Billing email" type="text" readonly />
            <x-form.input value="{{ $billing_addr->phone }}" label="Billing phone" type="text" readonly />
            <x-form.input value="{{ $billing_addr->street }}" label="Billing street" type="text" readonly />
            <x-form.input value="{{ $billing_addr->city }}" label="Billing city" type="text" readonly />
            <x-form.input value="{{ $billing_addr->state }}" label="Billing state" type="text" readonly />
            <x-form.input value="{{ $billing_addr->country }}" label="Billing country" type="text" readonly />
            <x-form.input value="{{ $billing_addr->postal_code }}" label="Billing postal_code" type="text" readonly />
        </div>
    </section>
    <section class="p-4 m-4 border rounded-md mt-4">
        <h2 class="text-xl text-bold text-center mb-3">Shipping Address</h2>
        <div>
            <x-form.input value="{{ $shipping_addr->first_name }}" label="Shipping first_name" type="text" readonly />
            <x-form.input value="{{ $shipping_addr->last_name }}" label="Shipping last_name" type="text" readonly />
            <x-form.input value="{{ $shipping_addr->email }}" label="Shipping email" type="text" readonly />
            <x-form.input value="{{ $shipping_addr->phone }}" label="Shipping phone" type="text" readonly />
            <x-form.input value="{{ $shipping_addr->street }}" label="Shipping street" type="text" readonly />
            <x-form.input value="{{ $shipping_addr->city }}" label="Shipping city" type="text" readonly />
            <x-form.input value="{{ $shipping_addr->state }}" label="Shipping state" type="text" readonly />
            <x-form.input value="{{ $shipping_addr->country }}" label="Shipping country" type="text" readonly />
            <x-form.input value="{{ $shipping_addr->postal_code }}" label="Shipping postal_code" type="text" readonly />
        </div>
    </section>
    <section class="p-4 m-4 border rounded-md mt-4">
        <h2 class="text-xl text-bold text-center mb-3">Order Products</h2>
        @foreach ($products as $product)
            <div class="mb-s4">
                <h2>ProductID: {{ $product->pivot->product_id }}</h2>
                <p>product_name: {{ $product->pivot->product_name }}</p>
                <p>product_price: {{ $product->pivot->product_price }}</p>
                <p>quantity: {{ $product->pivot->quantity }}</p>
            </div>
        @endforeach
    </section>
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
