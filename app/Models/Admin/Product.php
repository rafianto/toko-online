<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'user_id', 'sku', 'name', 'slug', 'price', 'weight', 'width', 'height', 'depth', 'short_description', 'description', 'status', 'deleted_at',
    ];
}
