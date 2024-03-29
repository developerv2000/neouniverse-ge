<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $with = [
        'categories',
    ];

    public function categories()
    {
        return $this->belongsToMany(ProductsCategory::class, 'category_product', 'product_id', 'category_id');
    }

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
