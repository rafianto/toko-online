<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    protected $table = 'product_attribute_values';

    protected $fillable = [
        'product_id', 'attribute_id', 'text_value', 'boolean_value', 'integer_value', 'float_value', 'datetime_value', 'date_value', 'json_value',
    ];
}
