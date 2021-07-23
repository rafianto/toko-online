<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductInventory extends Model
{
    use SoftDeletes;

    protected $table = 'product_inventories';

    protected $fillable = [
        'product_id', 'product_attribute_value_id', 'qty'
    ];
}