<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use File;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
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
        $banners = Banner::all();
        $title = "Banner  List";
        return view('admin.bannersList', compact(['banners', 'title']));
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
        $title = "Banner  Create";
        return view('admin.bannersCreate', compact(['title']));
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
            'name' => 'required|unique:banners',
            
            'image' =>  'image',
        ]);
        
            $image1 = $request->file('image');
            $imageName1 = time() . $image1->getClientOriginalName();
            $filePath1 = 'images/banner'. '/' . $imageName1;
            Storage::disk('s3')->put($filePath1, file_get_contents($image1));
        $banner = new Banner;
        $banner->name = $request->name;
        $banner->icon= "https://lynfashion.s3.ap-south-1.amazonaws.com/".$filePath1;
        $banner->save();
        session()->flash('success', 'Banner Added Successfully');
        return redirect()->route('banner.index');
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
        $banner = Banner::find($id);
        $title = "Banner  Edit";
        return view('admin.bannersEdit', compact(['banner', 'title']));
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



        $banner = Banner::find($id);
        $file = $request->file('image');
        if ($file != '') {
            $request->validate([
                'name' => 'required|unique:banners,name,' . $id,
                
                'image' =>  'image'
            ]);
            $image1 = $request->file('image');
            $imageName1 = time() . $image1->getClientOriginalName();
            $filePath1 = 'images/banner'. '/' . $imageName1;
            Storage::disk('s3')->put($filePath1, file_get_contents($image1));
            if ($banner->icon != null) {
                Storage::disk('s3')->delete(parse_url($banner->icon));
            }
            $banner->icon= "https://lynfashion.s3.ap-south-1.amazonaws.com/".$filePath1;
        } else {
            $request->validate([
                'name' => 'required|unique:banners,name,' . $id,
            ]);
        }
        $banner->name = $request->name;
        $banner->update();
        session()->flash('success', 'Banner Updated Successfully');
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner=Banner::find($id);
        session()->flash('success', 'Fabric Deleted Successfully');
        Storage::disk('s3')->delete(parse_url($banner->icon));
        $banner->delete();


        return redirect()->route('banner.index');
    }
}
