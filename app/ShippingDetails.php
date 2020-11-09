<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingDetails extends Model
{
    protected $fillable = [
        'order_id',
        'cus_name',
        'cus_phone',
        'cus_address',
        'cus_city',
        'cus_email',

   ];
}

