<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EcomOrderItems extends Model
{
    public function itemData()
    {
        return $this->hasMany('App\Product', 'id', 'product_id');
    }
}
