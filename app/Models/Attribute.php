<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use SoftDeletes;

    protected $table = 'attributes';

    protected $fillable = [
        'code', 'name', 'deleted_at', 'type', 'validation', 'is_required', 'is_unique',
        'is_filterable', 'is_configurable'
    ];

    public function getAllData($keyword = null, int $page = 10)
    {
        $attributes = $this->where('code', 'LIKE', "%$keyword%")
            ->orWhere('name', 'LIKE', "%$keyword%")
            ->orWhere('type', 'LIKE', "%$keyword%")
            ->orWhere('validation', 'LIKE', "%$keyword%")
            ->paginate($page);
        return $attributes;
    }

    /**
     * define types attribute
     * @return array
     */
    public static function types()
    {
        return [
            "text" => "Text",
            "textarea" => "Textarea",
            "price" => "Price",
            "boolean" => "Boolean",
            "select" => "Select",
            "datetime" => "Datetime",
            "date" => "Date",
        ];
    }

    /**
     * define boolean option
     * @return array
     */
    public static function booleanOptions(){
        return [
            1 => "Yes",
            0 => "No"
        ];
    }

    /**
     * define validation attribute
     * @return array
     */
    public static function validations(){
        return [
            "number" => "Number",
            "decimal" => "Decimal",
            "email" => "Email",
            "url" => "URL",
        ];
    }

    /**
     * relation attribute options
     * dimana attribute dapat dimiliki banyak di attribute options
     * one to many
     */
    public function attributeOptions()
    {
        return $this->hasMany('App\Models\AttributeOption');
    }
}