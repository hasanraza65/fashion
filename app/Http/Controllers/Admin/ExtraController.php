<?php

namespace App\Http\Controllers\Admin;

use App\Extra;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use File;
use Illuminate\Support\Facades\Storage;

class ExtraController extends Controller
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
        $extras = Extra::all();
        $title = "Trims List";
        return view('admin.extraList', compact(['extras', 'title']));
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
        $title = "Trims Create";
        return view('admin.extraCreate', compact(['title']));
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
            'name' => 'required|unique:extras',
            'price' => 'required',
            'image' =>  'image',
        ]);
        $image1 = $request->file('image');
        $imageName1 = time() . $image1->getClientOriginalName();
        $filePath1 = 'images/extra' . '/' . $imageName1;
        Storage::disk('s3')->put($filePath1, file_get_contents($image1));
        $extra = new Extra;
        $extra->name = $request->name;
        $extra->price = $request->price;
        $extra->icon_image = "https://lynfashion.s3.ap-south-1.amazonaws.com/" . $filePath1;
        $extra->save();
        session()->flash('success', 'Trims Added Successfully');
        return redirect()->route('extra.index');
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
        $extra = Extra::find($id);
        $title = "Trims Edit";
        return view('admin.extraEdit', compact(['extra', 'title']));
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
        $extra = Extra::find($id);
        $file = $request->file('image');
        if ($file != '') {
            $request->validate([
                'name' => 'required|unique:extras,name,' . $id,
                'price' => 'required',
                'image' =>  'image'
            ]);
            $image1 = $request->file('image');
            $imageName1 = time() . $image1->getClientOriginalName();
            $filePath1 = 'images/extra' . '/' . $imageName1;
            Storage::disk('s3')->put($filePath1, file_get_contents($image1));
            if ($extra->icon_image != null) {
                Storage::disk('s3')->delete(parse_url($extra->icon_image));
            }
            $extra->icon_image ="https://lynfashion.s3.ap-south-1.amazonaws.com/" . $filePath1;
        } else {
            $request->validate([
                'name' => 'required|unique:extras,name,' . $id,
                'price' => 'required',
            ]);
        }
        $extra->name = $request->name;
        $extra->price = $request->price;
        $extra->update();
        session()->flash('success', 'Trims Updated Successfully');
        return redirect()->route('extra.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $extra=Extra::find($id);
        session()->flash('success', 'extra Deleted Successfully');
        Storage::disk('s3')->delete(parse_url($extra->icon_image));
        $extra->delete();
        return redirect()->route('extra.index');
    }
}
