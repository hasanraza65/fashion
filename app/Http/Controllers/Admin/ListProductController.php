<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductCategory;
use App\ProductGallery;
use App\ProductSizes;
use Auth;
use File;
use Illuminate\Support\Facades\Storage;


class ListProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->is_admin == 0) {
            return redirect(route('home'));
        }

        $products = Product::all();
        $categories = ProductCategory::all();
        $title = "Product List";

        return view('admin.products.list', compact(['products', 'title', 'categories']));
    }

    public function apiProducts()
    {

        $products = Product::where('is_active', 1)->get();

        return view('admin.products.list', compact(['products']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->is_admin == 0) {
            return redirect(route('home'));
        }
        $title = "Product  Create";
        $categories = ProductCategory::all();

        return view('admin.products.add', compact(['title', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect(route('home'));
        }

        $request->validate([
            'name' => 'required|unique:products',
            'sort_description' => 'required',
            'description' => 'required',
            'image' =>  'image',
        ]);

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
        $product->category_id = $request->p_category;
        $product->save();

        //storing gallery images 
        for($i=0; $i<count($request->gallery_images); $i++){

        $gallery = new ProductGallery();

            if(isset($_FILES['gallery_images'])){
                if ($_FILES['gallery_images']['name'][$i]) {
                    if (!$_FILES['gallery_images']['error'][$i]) {
                       
                        $filetestname = request()->file('gallery_images')[$i];
                        $destination = Storage::disk('public')->put('/images', $filetestname);
                        //echo '/images/' . $filename;
    
                        $gallery->image = 'storage/'.$destination;
                    
                    } else {
    
                        //$gallery->image = 'storage/'.$request->old_pic;
                        $gallery->image = "";
    
                        //echo 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
                    }
                    
                  }
    
            }


        //$gallery->image = $request->gallery_images[$i];
        $gallery->product_id = $product->id;
        $gallery->save();

        }
        //ending storing gallery images

        session()->flash('success', ' Product Added Successfully');


        //product sizes
        if(!empty($request->size_name)){
            for($i=0; $i<count($request->size_name); $i++){
            $sizes = new ProductSizes();
            $sizes->size_name = $request->size_name[$i];
            $sizes->size_qty = $request->quantity[$i];
            $sizes->product_id = $product->id;
            $sizes->save();
            }
        }

        //ending product sizes

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->is_admin == 0) {
            return redirect(route('home'));
        }
        $product = Product::with('galleryImages')
        ->with('categoryDetail')
        ->with('userDetail')
        ->with('sizes')
        ->find($id);
        $categories = ProductCategory::all();
        $title = "Product  Edit";

        return view('admin.products.edit', compact(['product','title','categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (Auth::user()->is_admin == 0) {
            return redirect(route('home'));
        }

        $request->validate([
            'name' => 'required',
            'sort_description' => 'required',
            'description' => 'required',
            'image' =>  'image',
        ]);

        //storing image code 
        if($request->file('image') !== "" && $request->file('image') !== null){
        $image1 = $request->file('image');
        $imageName1 = time() . $image1->getClientOriginalName();
        $filePath1 = 'images/products' . '/' . $imageName1;
        Storage::disk('s3')->put($filePath1, file_get_contents($image1));
        $filecompleteurl = "https://lynfashion.s3.ap-south-1.amazonaws.com/".$filePath1;
        }else{
        $filecompleteurl = $request->oldimg;
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
        $product->is_active = $request->is_active;
        $product->category_id = $request->p_category;
        
        $product->update();

        $cleargallery = ProductGallery::where('product_id',$product->id)->delete();

        //storing gallery images 
        if(!empty($request->gallery_images)){
        for($i=0; $i<count($request->gallery_images); $i++){

            $gallery = new ProductGallery();
    
                if(isset($_FILES['gallery_images'])){
                    if ($_FILES['gallery_images']['name'][$i]) {
                        if (!$_FILES['gallery_images']['error'][$i]) {
                           
                            $filetestname = request()->file('gallery_images')[$i];
                            $destination = Storage::disk('public')->put('/images', $filetestname);
                            //echo '/images/' . $filename;
        
                            $gallery->image = 'storage/'.$destination;
                        
                        } else {
        
                            //$gallery->image = 'storage/'.$request->old_pic;
                            $gallery->image = "";
        
                            //echo 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
                        }
                        
                      }
        
                }
    
    
            //$gallery->image = $request->gallery_images[$i];
            $gallery->product_id = $product->id;
            $gallery->save();
    
            }
        }
            //ending storing gallery images

            //storing again old gallery imgs

            if(!empty($request->old_gal_imgs)){

                for($j=0; $j<count($request->old_gal_imgs); $j++){

                    $old_gallery = new ProductGallery();
                    $old_gallery->image = $request->old_gal_imgs[$j];
                    $old_gallery->product_id = $product->id;
                    $old_gallery->save();

                }

            }

            //ending storing again old gallery imgs

            //product sizes
            $clear_oldsizes = ProductSizes::where('product_id',$product->id)->delete();
            if(!empty($request->size_name)){
                for($i=0; $i<count($request->size_name); $i++){
                $sizes = new ProductSizes();
                $sizes->size_name = $request->size_name[$i];
                $sizes->size_qty = $request->quantity[$i];
                $sizes->product_id = $product->id;
                $sizes->save();
                }
            }

        //ending product sizes


        session()->flash('success', ' Product Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        
        Storage::disk('s3')->delete(parse_url($product->image));
        $product->delete();

        session()->flash('success', ' Product Deleted Successfully');
        return redirect()->route('products.index');
    }
}
