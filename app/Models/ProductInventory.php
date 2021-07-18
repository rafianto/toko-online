<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{
    protected $table = 'product_inventories';

    protected $fillable = [
        'product_id', 'product_attribute_value_id', 'qty'
    ];
}
