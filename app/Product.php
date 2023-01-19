<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function  categoryDetail()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');

    }

	public function userDetail()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function  galleryImages()
    {
        return $this->hasMany(ProductGallery::class,'product_id');

    }

    public function  sizes()
    {
        return $this->hasMany(ProductSizes::class,'product_id');

    }
}
