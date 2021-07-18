<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'product_id', 'path',
    ];

    // relasi ke table products
    public function product()
    {
        return $this->belongsTo("App\Models\Product");
    }
}
