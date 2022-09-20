<?php

namespace App\Http\Controllers;
use App\Product;
use App\ProductCategory;

use Illuminate\Http\Request;

class AllProductsController extends Controller
{
    public function apiProducts()
    {

        $products = Product::where('is_active', 1)->get();

        return response(['products' => $products]);
    }

    public function apiProductsCategories()
    {

        $productscategories = ProductCategory::all();

        return response(['product_categories' => $productscategories]);
    }

    public function productDetail($id){

       
        $product = Product::find($id);
        $categories = ProductCategory::all();

        return response(['product' => $product]);

    }

    public function searchProducts(Request $request){

        $name = $request->title;

        $products = Product::where('name', 'LIKE', '%'.$name.'%')
        ->get();

        return response(['products' => $products]);
    }

    public function productsByCategory(Request $request){

        $category_id = $request->category_id;

        $products = Product::where('category_id',$category_id)
        ->get();

        return response(['products' => $products]);
    }
}
