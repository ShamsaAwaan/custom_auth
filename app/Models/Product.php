<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
protected $fillable = [
    'name',
    'sku',
    'category_id',
    'sub_category_id',
    'cost',
    'price',
    'quantity',
    'image',
    'slug',
    'description',
    'is_active'
];

    public function category()
{
    return $this->belongsTo(Category::class);
}

public function subCategory()
{
    return $this->belongsTo(SubCategory::class);
}

}

