<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'category_id',
         'brand_id',
         'product_name',
         'product_slug',
         'product_code',
         'product_quantity',
         'short_description',
         'long_description',
         'price',
         'image_one',
         'image_two',
         'image_three',
         'status',
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function review(){
        return $this->hasMany(Review::class);
    }
    // public function ratingcount(){
    //    $starc=$this->review()->sum('rating');
    //    $avg=$starc/5;
    //    return $avg;
    // }
}
