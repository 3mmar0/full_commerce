<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'disc',
        'img',
        'status',
    ];

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

    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required', 'string', 'min:3', 'max:150',
                Rule::unique('categories', 'name')->ignore($id)
            ],
            'parent_id' => [
                'nullable', 'int', 'exists:categories,id'
            ],
            'img' => [
                'image', 'max:1048576',
            ],
            'status' => 'in:active,disactive'
        ];
    }
}
