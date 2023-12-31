<?php

namespace App\Models;

use App\Models\Admin\Product;
use App\Models\Admin\Store;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_method',
        'store_id',
        'user_id',
        'status',
        'payment_status',
    ];


    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)
            ->withDefault([
                'name' => 'Guest User'
            ]);
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'order_items',
            'order_id',
            'product_id',
        )
            ->using(OrderItem::class)
            ->withPivot([
                'product_name',
                'product_price',
                'quantity',
                'options'
            ]);
    }

    public function addresses()
    {
        return $this->hasMany(
            OrderAddress::class,
        );
    }

    public function billingAddresses()
    {
        return $this->hasOne(
            OrderAddress::class,
            'order_id',
            'id',
        )->where('type', 'billing');
    }

    public function shippingAddresses()
    {
        return $this->hasOne(
            OrderAddress::class,
            'order_id',
            'id',
        )->where('type', 'shipping');
    }

    protected static function booted()
    {
        static::creating(function (Order $order) {
            $order->number = Order::getNextOrderNum();
        });
    }

    public static function getNextOrderNum()
    {
        $year = Carbon::now()->year;
        // dd($year);
        $number =  Order::whereYear('created_at', $year)->max('number');
        // dd($number);
        if ($number) {
            return $number + 1;
        }

        return $year . '0001';
    }
}
