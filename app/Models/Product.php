<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories(){
        return $this->belongsTo('App\Models\Categories');
    }
    public function brands(){
        return $this->belongsTo('App\Models\Brands');
    }
    public static function getDataProduct()
    {
        $products = Product::all();
        $products_filter = [];
        $no = 1;
        for ($i=0; $i < $products->count(); $i++){
            $products_filter[$i]['no'] = $no++;
            $products_filter[$i]['name'] = $products[$i]->name;
            $products_filter[$i]['categories_id'] = $products[$i]->categories->name;
            $products_filter[$i]['brands_id'] = $products[$i]->brands->name;
            $products_filter[$i]['harga'] = $products[$i]->harga;
            $products_filter[$i]['qty'] = $products[$i]->qty;
        }
        return $products_filter;
    }
}
