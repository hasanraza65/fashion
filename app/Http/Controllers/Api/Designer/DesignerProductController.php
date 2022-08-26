<?php

namespace App\Http\Controllers\Api\Designer;

use App\Product;
use App\DesignerProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use auth;
use File;

class DesignerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }
        $products = Product::where('user_id', auth::user()->id)->get();
       
        return response(['my_products' => $products]);
    }
    public function designerProducts($id)
    {
        //$designer_id=1;
        $products = Product::where('user_id',$id)->get();
       
        return response(['designer_products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }
        $input = $request->all();

        $rules = array(
            'name' => 'required|unique:products',
            'sort_description' => 'required',
            'description' => 'required',
            'image' =>  'image',
        );

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {

        //storing image code 
        if($request->file('image') !== "" && $request->file('image') !== null){
        $image1 = $request->file('image');
        $imageName1 = time() . $image1->getClientOriginalName();
        $filePath1 = 'images/products' . '/' . $imageName1;
        Storage::disk('s3')->put($filePath1, file_get_contents($image1));
        $filecompleteurl = "https://lynfashion.s3.ap-south-1.amazonaws.com/".$filePath1;
        }else{
        $filecompleteurl = "";
        }
        //ending storing image

        if($request->p_qty < 1 || $request->p_qty == ""){
            $in_stock = 0;
        }else{
            $in_stock = 1;
        }

        $product = new Product;
        $product->name = $request->name;
        $product->user_id = Auth::user()->id;
        $product->sort_description = $request->sort_description;
        $product->description = $request->description;
        $product->image = $filecompleteurl;
        $product->p_qty = $request->p_qty;
        $product->p_price = $request->p_price;
        $product->in_stock = $in_stock;
        $product->save();

        $products = Product::where('user_id', auth::user()->id)->get();
        
        $arr = array("status" => 200, "message" => 'Product Added', "my_products" => $products);

        }
        return response($arr);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DesignerProduct  $designerProduct
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }

        $product = Product::find($id);
        
        if(isset($product->user_id)){

            if($product->user_id == Auth::user()->id){

                if($product){
                    $message = 'Product Found';
                }else{
                    $message = 'Product Not Found';
                }

                $arr = array("status" => 200, "message" => $message, "my_product" => $product);

                return $arr;

            }else{
                return response('unauthorized', 401);
            }

        }else{
            return response('unauthorized', 401);
        }

        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DesignerProduct  $designerProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(DesignerProduct $designerProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DesignerProduct  $designerProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }

        $input = $request->all();

        $rules = array(
            'name' => 'required|unique:products',
            'sort_description' => 'required',
            'description' => 'required',
            'image' =>  'image',
        );

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {

        $product = Product::find($id);

        if($product->user_id == Auth::user()->id){

        //storing image code 
        if($request->file('image') !== "" && $request->file('image') !== null){
        $image1 = $request->file('image');
        $imageName1 = time() . $image1->getClientOriginalName();
        $filePath1 = 'images/products' . '/' . $imageName1;
        Storage::disk('s3')->put($filePath1, file_get_contents($image1));
        $filecompleteurl = "https://lynfashion.s3.ap-south-1.amazonaws.com/".$filePath1;
        }else{
        $filecompleteurl = "";
        }
        //ending storing image

        if($request->p_qty < 1 || $request->p_qty == ""){
            $in_stock = 0;
        }else{
            $in_stock = 1;
        }

        $product = Product::find($id);
        $product->name = $request->name;
        $product->user_id = Auth::user()->id;
        $product->sort_description = $request->sort_description;
        $product->description = $request->description;
        $product->image = $filecompleteurl;
        $product->p_qty = $request->p_qty;
        $product->p_price = $request->p_price;
        $product->in_stock = $in_stock;
        $product->update();

        $products = Product::where('user_id', auth::user()->id)->get();
        
        $arr = array("status" => 200, "message" => 'Product Updated', "my_products" => $products);
        return response($arr);
            }
        return response('unauthorized', 401);
        }
        return $arr;
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DesignerProduct  $designerProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);

        if($product->user_id == Auth::user()->id){
        
        Storage::disk('s3')->delete(parse_url($product->image));
        $product->delete();

        $products = Product::where('user_id', Auth::user()->id)->get();

        $arr = array("status" => 200, "message" => 'Product Deleted', "my_products" => $products);

        return $arr;
        }else{
        return response('unauthorized', 401);
        }
    }
}
