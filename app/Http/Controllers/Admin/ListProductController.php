<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
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
        $title = "Product List";

        return view('admin.products.list', compact(['products', 'title']));
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

        return view('admin.products.add', compact(['title']));
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
        $product->save();
        session()->flash('success', ' Product Added Successfully');
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
        $product = Product::find($id);
        $title = "Product  Edit";

        return view('admin.products.edit', compact(['product','title']));
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
        
        $product->update();
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
