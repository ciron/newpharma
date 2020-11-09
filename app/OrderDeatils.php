<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDeatils extends Model
{
    protected $fillable = [
        'order_id',
        'product_name',
        'price',
        'totallprice',
        'qty',

   ];
}
