<?php

namespace App\Observers;

use App\Models\Cart;
use Illuminate\Support\Str;

class CartObserver
{
    /**
     * Handle the cart "creating" event.
     */
    public function creating(cart $cart): void
    {
        $cart->id = Str::uuid();
        $cart->cookie_id = Cart::getCookieId();
    }

    /**
     * Handle the cart "updated" event.
     */
    public function updated(Cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "deleted" event.
     */
    public function deleted(Cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "restored" event.
     */
    public function restored(Cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "force deleted" event.
     */
    public function forceDeleted(Cart $cart): void
    {
        //
    }
}
