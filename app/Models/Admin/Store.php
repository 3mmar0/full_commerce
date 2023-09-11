<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'disc',
        'logo',
        'cover',
        'status',
    ];

    // relations
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    // End relations
}
