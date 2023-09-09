<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'disc',
        'image',
        'price',
        'compare_price',
        'category_id',
        'store_id',
        'featured',
    ];
}
