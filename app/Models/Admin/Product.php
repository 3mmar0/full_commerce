<?php

namespace App\Models\Admin;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        'quantity',
    ];

    protected static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder) {
            $user = Auth::user();
            if ($user && $user->store_id && $user->role != 'admin') {
                # code...
                $builder->where('store_id', $user->store_id);
            }
        });
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', '=', 'active');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        if ($filters['name'] ?? false) {
            $builder->where('name', 'LIKE', "%{$filters['name']}%");
        }
        if ($filters['status'] ?? false) {
            $builder->where('status', '=', $filters['status']);
        }
    }

    // relations
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id',
        );
    }
    // End relations

    // Accessors
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://www.bevi.com/static/files/0/ecommerce-default-product.png';
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }
    public function getSalePriceAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }

        return round(($this->price / $this->compare_price * 100) - 100, 1);
    }
}
