<?php

namespace App\Http\Controllers\Admin;

use App\Catlog_category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use File;
use Illuminate\Support\Facades\Storage;

class CatlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->is_admin == 0) {
            return redirect(route('home'));
        }
        $catlog_categories = Catlog_category::all();
        $title = "Catlog Categories List";
        return view('admin.catlogCategoriesList', compact(['catlog_categories', 'title']));
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
        $title = "Catlog Category Create";
        return view('admin.catlogCategoriesCreate', compact(['title']));
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
            'name' => 'required|unique:catlog_categories',

            'image' =>  'image',
        ]);
        $image1 = $request->file('image');
        $imageName1 = time() . $image1->getClientOriginalName();
        $filePath1 = 'images/catlog_categories' . '/' . $imageName1;
        Storage::disk('s3')->put($filePath1, file_get_contents($image1));
        $cat = new Catlog_category;
        $cat->name = $request->name;
        $cat->icon = "https://lynfashion.s3.ap-south-1.amazonaws.com/" . $filePath1;
        $cat->save();
        session()->flash('success', 'Category Added Successfully');
        return redirect()->route('cat.index');
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
        $category = Catlog_category::find($id);
        $title = "Catlog Category Edit";
        return view('admin.catlogCategoriesEdit', compact(['category', 'title']));
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



        $cat = Catlog_category::find($id);
        $file = $request->file('image');
        if ($file != '') {
            $request->validate([
                'name' => 'required|unique:catlog_categories,name,' . $id,

                'image' =>  'image'
            ]);
            $image1 = $request->file('image');
            $imageName1 = time() . $image1->getClientOriginalName();
            $filePath1 = 'images/catlog_categories' . '/' . $imageName1;
            Storage::disk('s3')->put($filePath1, file_get_contents($image1));
            if ($cat->icon != null) {
                Storage::disk('s3')->delete(parse_url($cat->icon));
            }
            $cat->icon = "https://lynfashion.s3.ap-south-1.amazonaws.com/" . $filePath1;
        } else {
            $request->validate([
                'name' => 'required|unique:catlog_categories,name,' . $id,



            ]);
        }
        $cat->name = $request->name;
        $cat->update();
        session()->flash('success', 'Category Updated Successfully');
        return redirect()->route('cat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Catlog_category::find($id);
        session()->flash('success', 'Fabric Deleted Successfully');
        Storage::disk('s3')->delete(parse_url($cat->icon));
        $cat->delete();


        return redirect()->route('cat.index');
    }
}
