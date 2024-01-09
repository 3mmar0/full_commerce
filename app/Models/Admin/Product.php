<?php

namespace App\Models\Admin;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = [
        'name',
        'slug',
        'disc',
        'price',
        'compare_price',
    ];
    protected $fillable = [
        'image',
        'category_id',
        'store_id',
        'featured',
        'quantity',
    ];

    protected static function booted()
    {
        // static::addGlobalScope('store', function (Builder $builder) {
        //     $user = Auth::user();
        //     if ($user && $user->store_id && $user->role != 'admin') {
        //         # code...
        //         $builder->where('store_id', $user->store_id);
        //     }
        // });

        static::creating(function (Product $product) {
            $product->translate('en')->slug = Str::slug($product->translate('en')->name);
            $product->translate('ar')->slug = Str::slug($product->translate('ar')->name);
        });
        static::updating(function (Product $product) {
            $product->translate('en')->slug = Str::slug($product->translate('en')->name);
            $product->translate('ar')->slug = Str::slug($product->translate('ar')->name);
        });
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', '=', 'active');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'category_id' => null,
            'tag_id' => null,
            'status' => 'active',
        ], $filters);
        if ($filters['name'] ?? false) {
            $builder->where('name', 'LIKE', "%{$filters['name']}%");
        }
        $builder->when($options['status'], function ($builder, $value) {
            $builder->whereStatus($value);
        });
        $builder->when($options['category_id'], function ($builder, $value) {
            $builder->whereCategoryId($value);
        });
        $builder->when($options['tag_id'], function ($builder, $value) {
            // $builder->whereHas('tags', function($builder) use ($value){
            //     $builder->whereIn('id', $value);
            // });
            $builder->whereExists(function ($query) use ($value) {
                $query->select(1)
                    ->from('product_tags')
                    ->whereRaw('product_id = products.id')
                    ->whereIn('tag_id', $value);
            });
        });
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

    public static function rules($id = 0)
    {
        return [
            'name:en' => [
                'required', 'string', 'min:3', 'max:255',
            ],
            'name:ar' => [
                'required', 'string', 'min:3', 'max:255',
            ],
            'disc' => [
                'nullable', 'int', 'exists:categories,id'
            ],
            'img' => [
                'image', 'max:1048576',
            ],
        ];
    }
}
