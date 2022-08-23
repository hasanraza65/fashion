<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EcomOrders extends Model
{
    public function orderItems()
    {
        return $this->hasMany('App\EcomOrderItems', 'ecom_order_id', 'id');
    }

    
}
