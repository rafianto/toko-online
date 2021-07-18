<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'slug', 'parent_id'
    ];

    public function childs() {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function parent() {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function products()
    {
        return $this->belongToMany('App\Models\Product', 'product_categories');
    }

    /**
     * Method For Get All Data
     * without keyword or with keyword
     */
    public function getAllData($keyword = null, $size = 10)
    {
        $categories = $this->where('id', 'like', '%' . (int)$keyword . '%')
                    ->orWhere('name', 'like', '%' . $keyword . '%')
                    ->orWhere('slug', 'like', '%' . $keyword . '%')
                    ->orWhere('created_at', 'like', '%' . $keyword . '%')
                    ->orWhere('updated_at', 'like', '%' . $keyword . '%')
                    ->orderBy('name', 'ASC')
                    ->paginate((int) $size);
        return $categories;
    }
}
