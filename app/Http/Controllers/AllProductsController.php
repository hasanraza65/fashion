<?php

namespace App\Http\Controllers;
use App\Product;
use App\ProductCategory;

use Illuminate\Http\Request;

class AllProductsController extends Controller
{
    public function apiProducts()
    {

        $products = Product::where('is_active', 1)
        ->with('categoryDetail')
        ->with('userDetail')
        ->with('galleryImages')
        ->with('sizes')
        ->get();

        if(count($products)>0){
            $message = "Products Found";
        }else{

            $message = "No Any Product Found";
        }

        return response(['success'=>true,'message'=>$message,'data' => $products]);
    }

    public function apiProductsCategories()
    {

        $productscategories = ProductCategory::all();

        if(count($productscategories)>0){
            $message = "Categories Found";
        }else{

            $message = "No Any Category Found";
        }

        return response(['success'=>true, 'message'=>$message, 'data' => $productscategories]);

    }

    public function productDetail($id){

       
        $product = Product::with('categoryDetail')
        ->with('galleryImages')
        ->with('userDetail')
        ->with('sizes')
        ->find($id);
        $categories = ProductCategory::all();

        if($product){
            $message = "Product Found";
        }else{

            $message = "No Any Product Found";
        }

        return response(['success'=>true, 'message'=>$message, 'data' => $product]);

    }

    public function searchProducts(Request $request){

        $name = $request->title;

        $products = Product::where('name', 'LIKE', '%'.$name.'%')
        ->with('galleryImages')
        ->with('categoryDetail')
        ->with('userDetail')
        ->with('sizes')
        ->get();

        if(count($products)>0){
            $message = "Products Found";
        }else{

            $message = "No Any Product Found";
        }

        return response(['success'=>true, 'message'=>$message, 'data' => $products]);
    }

    public function productsByCategory(Request $request){

        $category_id = $request->category_id;

        $products = Product::where('category_id',$category_id)
        ->with('galleryImages')
        ->with('categoryDetail')
        ->with('userDetail')
        ->with('sizes')
        ->get();

        if(count($products)>0){
            $message = "Products Found";
        }else{

            $message = "No Any Product Found";
        }

        return response(['success'=>true, 'message'=>$message, 'data' => $products]);
    }

    public function productsByDesigner($id)
    {

        $products = Product::where('is_active', 1)
        ->with('galleryImages')
        ->with('categoryDetail')
        ->with('userDetail')
        ->with('sizes')
        ->where('user_id',$id)
        ->get();

        if(count($products)>0){
            $message = "Products Found";
        }else{

            $message = "No Any Product Found";
        }

        return response(['success'=>true,'message'=>$message,'data' => $products]);
    }
}
