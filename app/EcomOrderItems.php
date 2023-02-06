<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EcomOrderItems extends Model
{
    public function itemData()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }

    public function sizesData()
    {
        return $this->hasMany('App\ProductSizes', 'id', 'selected_size');
    }
}
