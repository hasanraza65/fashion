<?php

namespace App\Http\Controllers;
use App\Product;

use Illuminate\Http\Request;

class AllProductsController extends Controller
{
    public function apiProducts()
    {

        $products = Product::where('is_active', 1)->get();

        return response(['products' => $products]);
    }
}
