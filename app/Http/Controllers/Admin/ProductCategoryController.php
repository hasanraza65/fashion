<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductCategory;

class ProductCategoryController extends Controller
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
        $product_category = ProductCategory::all();
        $title = "Product Categories List";
        // return view('admin.catlogCategoriesList', compact(['catlog_categories', 'title']));
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
        $title = "Product Category Create";
        // return view('admin.catlogCategoriesCreate', compact(['title']));
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
            'name' => 'required|unique:product_categories',
            'icon' =>  'image',
        ]);
        $image1 = $request->file('icon');
        $imageName1 = time() . $image1->getClientOriginalName();
        $filePath1 = 'images/product_categories' . '/' . $imageName1;
        Storage::disk('s3')->put($filePath1, file_get_contents($image1));
        $product_category = new ProductCategory;
        $product_category->name = $request->name;
        $product_category->icon = "https://lynfashion.s3.ap-south-1.amazonaws.com/" . $filePath1;
        $product_category->save();
        session()->flash('success', 'Product Category Added Successfully');
        // return redirect()->route('cat.index');
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
        $product_category = ProductCategory::find($id);
        $title = "Product Category Edit";
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



        $product_category = ProductCategory::find($id);
        $file = $request->file('image');
        if ($file != '') {
            $request->validate([
                'name' => 'required|unique:product_categories,name,' . $id,
                'icon' =>  'image'
            ]);
            $image1 = $request->file('icon');
            $imageName1 = time() . $image1->getClientOriginalName();
            $filePath1 = 'images/product_categories' . '/' . $imageName1;
            Storage::disk('s3')->put($filePath1, file_get_contents($image1));
            if ($product_category->icon != null) {
                Storage::disk('s3')->delete(parse_url($product_category->icon));
            }
            $product_category->icon = "https://lynfashion.s3.ap-south-1.amazonaws.com/" . $filePath1;
        } else {
            $request->validate([
                'name' => 'required|unique:product_categories,name,' . $id,
            ]);
        }
        $product_category->name = $request->name;
        $product_category->update();
        session()->flash('success', 'Product Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_category = ProductCategory::find($id);
        session()->flash('success', 'Product Category Deleted Successfully');
        Storage::disk('s3')->delete(parse_url($product_category->icon));
        $product_category->delete();


    }
}
