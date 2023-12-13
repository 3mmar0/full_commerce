<?php

namespace App\Models;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItem extends Pivot
{
    use HasFactory;

    protected $table = 'order_items';
    protected $incrementing = true;

    public function product()
    {
        return $this->belongsTo(Product::class)
            ->withDefault([
                'name' => $this->product_name
            ]);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
