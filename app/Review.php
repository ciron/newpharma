<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'cus_review',
        'rating',

   ];
   public function product(){
    return $this->belongsTo(Product::class,'product_id');
}

}
