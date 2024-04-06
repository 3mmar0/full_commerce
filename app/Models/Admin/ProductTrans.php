<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTrans extends Model
{
    use HasFactory;

    protected $table = 'product_translations';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'slug',
        'disc',
        'price',
        'compare_price',
        'product_id',
        'locale',
    ];
}
