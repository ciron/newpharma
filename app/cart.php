<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{

    protected $fillable = [
        'product_id', 'qty','price','user_ip',
    ];
    protected $foreginKey = 'product_id';
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
