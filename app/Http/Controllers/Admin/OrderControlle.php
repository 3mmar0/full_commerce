<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderControlle extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate();

        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id)
    {
        $order = Order::findorfail($id);
        $billing_addr = $order->billingAddresses;
        $shipping_addr = $order->shippingAddresses;
        $products = $order->products;
        // dd($products);
        return view('admin.orders.edit', compact('order', 'billing_addr', 'shipping_addr', 'products'));
    }
    public function update(Request $request, $id)
    {
        $order = Order::findorfail($id);
        $order->update([
            'status' => $request->post('status') ?? $order->status,
            'payment_status' => $request->post('payment_status') ?? $order->payment_status,
        ]);

        return redirect()->route('dashboard.orders.index')->with(
            'success',
            'Order updated'
        );
    }
    public function destroy($id)
    {
        $cat = Order::findorfail($id);
        $cat->forceDelete();

        return redirect()->route('dashboard.orders.index')->with(
            'success',
            'Order deleted'
        );
    }
}
