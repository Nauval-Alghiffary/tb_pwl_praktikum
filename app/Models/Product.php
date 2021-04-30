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
}
