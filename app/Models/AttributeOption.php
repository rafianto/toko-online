<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    protected $table = 'attribute_options';

    protected $fillable = [
        'attribute_id', 'name'
    ];
}
