<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'user_id', 'sku', 'name', 'slug', 'price', 'weight', 'width', 'height', 'depth', 'short_description', 'description', 'status', 'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // relation to category
    public function categories()
    {
        // Relasi Ke Model  Category dan artiifact table nya product_categories
        return $this->belongsToMany('App\Models\Category', 'product_categories');
    }

    // Relasi Product ke ProductImages
    public function productImages()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    // status product
    public function statuses()
    {
        return [
            0 => 'Draft',
            1 => 'Active',
            2 => 'Inactive',
        ];
    }

    public function getAllData($keyword = null, $size = 10)
    {
        $products = $this->where('id', 'LIKE', '%' . (int)$keyword . '%')->orWhere('name', 'LIKE', '%' . $keyword . '%')->orWhere('sku', 'LIKE', '%' . $keyword . '%')
        ->orWhere('slug', 'LIKE', '%' . $keyword . '%')
        ->orWhere('price', 'LIKE', '%' . (float)$keyword . '%')
        ->orWhere('status', 'LIKE', '%' . (int)$keyword . '%')
        ->orderBy('name', 'ASC')
        ->paginate($size);
        return $products;
    }

    public function generateSKU(){
        $table = 'products';
        $data = DB::select("SELECT MAX(sku) AS sku FROM $table LIMIT 1");

        $urutan;
        if ($data[0]->sku == null || $data[0]->sku == "") {
            $urutan = 1;
        }

        $no_baru;
        foreach ($data as $row) {
            $no_baru = $row->sku;
        }

        $code = "ECM-";
        $urutan = (int) substr($no_baru, 4, 5);
        $urutan++;
        $sku = $code . sprintf('%05s', $urutan);
        return $sku;
    }
}