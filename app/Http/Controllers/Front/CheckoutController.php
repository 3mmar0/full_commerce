<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    public function create(CartRepository $cart)
    {
        if ($cart->get()->count() == 0) {
            return redirect()->route('home');
        }
        return view('front.checkout', [
            'cart' => $cart,
            'countries' => Countries::getNames(),
        ]);
    }
    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            'addr.billing.first_name' => ['required', 'string', 'max:255'],
            'addr.billing.last_name' => ['required', 'string', 'max:255'],
            'addr.billing.phone' => ['required', 'string', 'max:255'],
            'addr.billing.email' => ['nullable', 'email', 'max:255'],
            'addr.billing.street' => ['required', 'string', 'max:255'],
            'addr.billing.city' => ['required', 'string', 'max:255'],
            'addr.billing.state' => ['nullable', 'string', 'max:255'],
            'addr.billing.country' => ['required', 'string', 'min:2', 'max:2'],
            'addr.billing.postal_code' => ['nullable', 'string', 'max:255'],
            // shipping
            'addr.shipping.first_name' => ['required', 'string', 'max:255'],
            'addr.shipping.last_name' => ['required', 'string', 'max:255'],
            'addr.shipping.phone' => ['required', 'string', 'max:255'],
            'addr.shipping.email' => ['nullable', 'email', 'max:255'],
            'addr.shipping.street' => ['required', 'string', 'max:255'],
            'addr.shipping.city' => ['required', 'string', 'max:255'],
            'addr.shipping.state' => ['nullable', 'string', 'max:255'],
            'addr.shipping.country' => ['required', 'string', 'min:2', 'max:2'],
            'addr.shipping.postal_code' => ['nullable', 'string', 'max:255'],
        ]);

        DB::beginTransaction();

        $items = $cart->get()->groupBy('product.store_id')->all();
        // dd($items);
        try {
            //code...
            foreach ($items as $store_id => $cart_items) {
                // dd($items);
                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod',
                ]);

                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'product_price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                }
                // dd($request->post('addr'));
                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
            }
            DB::commit();
            event(new OrderCreated($order));
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return redirect()->route('home');
    }
}
