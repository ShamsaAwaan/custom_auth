<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'image',
        'sub_category_id',
        'is_active',
    ];

    // RELATION
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
