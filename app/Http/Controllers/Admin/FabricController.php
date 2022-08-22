<?php

namespace App\Http\Controllers\Admin;

use App\Fabric;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use File;
use Illuminate\Support\Facades\Storage;

class FabricController extends Controller
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
        $fabrics = Fabric::all();
        $title = "Fabric List";
        return view('admin.fabricList', compact(['fabrics', 'title']));
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
        $title = "Fabric Create";
        return view('admin.fabricCreate', compact(['title']));
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
            'name' => 'required|unique:fabrics',
            'description' => 'required',
            'price' => 'required',
            'image' =>  'image',
        ]);
        $image1 = $request->file('image');
        $imageName1 = time() . $image1->getClientOriginalName();
        $filePath1 = 'images/fabric' . '/' . $imageName1;
        Storage::disk('s3')->put($filePath1, file_get_contents($image1));
        $fabric = new Fabric;
        $fabric->name = $request->name;
        $fabric->description = $request->description;
        $fabric->price = $request->price;
        $fabric->icon_image = "https://lynfashion.s3.ap-south-1.amazonaws.com/" . $filePath1;
        $fabric->save();
        session()->flash('success', 'Fabric Added Successfully');
        return redirect()->route('fabric.index');
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
        $fabric = Fabric::find($id);
        $title = "Fabric Edit";
        return view('admin.fabricEdit', compact(['fabric', 'title']));
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



        $fabric = Fabric::find($id);
        $file = $request->file('image');
        if ($file != '') {
            $request->validate([
                'name' => 'required|unique:fabrics,name,' . $id,
                'description' => 'required',
                'price' => 'required',
                'image' =>  'image'
            ]);
            $image1 = $request->file('image');
            $imageName1 = time() . $image1->getClientOriginalName();
            $filePath1 = 'images/fabric' . '/' . $imageName1;
            Storage::disk('s3')->put($filePath1, file_get_contents($image1));
            if ($fabric->icon_image != null) {
                Storage::disk('s3')->delete(parse_url($fabric->icon_image));
            }
            $fabric->icon_image = "https://lynfashion.s3.ap-south-1.amazonaws.com/" . $filePath1;
        } else {
            $request->validate([
                'name' => 'required|unique:fabrics,name,' . $id,
                'description' => 'required',
                'price' => 'required',
            ]);
        }
        $fabric->name = $request->name;
        $fabric->description = $request->description;
        $fabric->price = $request->price;
        $fabric->update();
        session()->flash('success', 'Fabric Updated Successfully');
        return redirect()->route('fabric.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fabric = Fabric::find($id);
        session()->flash('success', 'Fabric Deleted Successfully');
        Storage::disk('s3')->delete(parse_url($fabric->icon_image));
        $fabric->delete();
        return redirect()->route('fabric.index');
    }
}
