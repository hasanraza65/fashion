<?php

namespace App\Http\Controllers\Api\Designer;

use App\Catlog;
use App\Catlog_category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use auth;
use File;

class CatlogController extends Controller
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
        $my_catlogs = Catlog::where('user_id', auth::user()->id)->get();
        $catlog_categories = Catlog_category::all();
        return response(['my_catlogs' => $my_catlogs, 'catlog_categories' => $catlog_categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'img1' => 'required',
            'img2' => 'required',
            'img3' => 'required',

        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {

            $image1 = $request->file('img1');
            $imageName1 = time() . $image1->getClientOriginalName();
            $filePath1 = 'images/catlog/' . $imageName1;
            Storage::disk('s3')->put($filePath1, file_get_contents($image1));

            $image2 = $request->file('img2');
            $imageName2 = time() . $image2->getClientOriginalName();
            $filePath2 = 'images/catlog/' . $imageName2;
            Storage::disk('s3')->put($filePath2, file_get_contents($image2));


            $image3 = $request->file('img3');
            $imageName3 = time() . $image3->getClientOriginalName();
            $filePath3 = 'images/catlog/' . $imageName3;
            Storage::disk('s3')->put($filePath3, file_get_contents($image3));


            $catlog = new Catlog;
            $catlog->name = $request->name;
            $catlog->category_id = $request->category_id;
            $catlog->user_id = auth::user()->id;
            $catlog->description = $request->description;
            $catlog->img1 =  $filePath1;
            $catlog->img2 =  $filePath2;
            $catlog->img3 =  $filePath3;
            $catlog->save();
            $my_catlogs = Catlog::where('user_id', auth::user()->id)->get();
            $catlog_categories = Catlog_category::all();
            $arr = array("status" => 200, "message" => 'Catlog Added', "my_catlogs" => $my_catlogs, "catlog_categories" => $catlog_categories);
        }
        return response($arr);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }
        $input = $request->all();
        $rules = array(

            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',


        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            $catlog = Catlog::find($id);


            $file1 = $request->file('img1');
            if ($file1 != '') {

                $imageName1 = time() . $file1->getClientOriginalName();
                $filePath1 = 'images/catlog/' . '/' . $imageName1;
                Storage::disk('s3')->put($filePath1, file_get_contents($file1));
                if ($catlog->img1 != null) {
                    Storage::disk('s3')->delete(parse_url($catlog->img1));
                }
                $catlog->img1 = "https://lynfashion.s3.ap-south-1.amazonaws.com/".$filePath1;

            }

            $file2 = $request->file('img2');
            if ($file2 != '') {
                $imageName2 = time() . $file2->getClientOriginalName();
                $filePath2 = 'images/catlog/' . '/' . $imageName2;
                Storage::disk('s3')->put($filePath2, file_get_contents($file2));
                if ($catlog->img1 != null) {
                    Storage::disk('s3')->delete(parse_url($catlog->img2));
                }
                $catlog->img2 = "https://lynfashion.s3.ap-south-1.amazonaws.com/".$filePath2;


            }

            $file3 = $request->file('img3');
            if ($file3 != '') {

                $imageName3 = time() . $file3->getClientOriginalName();
                $filePath3 = 'images/catlog/' . '/' . $imageName3;
                Storage::disk('s3')->put($filePath3, file_get_contents($file3));
                if ($catlog->img3 != null) {
                    Storage::disk('s3')->delete(parse_url($catlog->img3));
                }
                $catlog->img3 = "https://lynfashion.s3.ap-south-1.amazonaws.com/".$filePath3;

            }

            $catlog->name = $request->name;
            $catlog->category_id = $request->category_id;
            $catlog->description = $request->description;

            $catlog->update();
            $my_catlogs = Catlog::where('user_id', auth::user()->id)->get();
            $catlog_categories = Catlog_category::all();
            $arr = array("status" => 200, "message" => 'Catlog Updated', "my_catlogs" => $my_catlogs, "catlog_categories" => $catlog_categories);
        }
        return response($arr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }
        $catlog = Catlog::find($id);
        Storage::disk('s3')->delete(parse_url($catlog->img1));
        Storage::disk('s3')->delete(parse_url($catlog->img2));
        Storage::disk('s3')->delete(parse_url($catlog->img3));
        $catlog->delete();
        $my_catlogs = Catlog::where('user_id', auth::user()->id)->get();

        $catlog_categories = Catlog_category::all();
        $arr = array("status" => 200, "message" => 'Catlog Deleted', "my_catlogs" => $my_catlogs, "catlog_categories" => $catlog_categories);

        return response($arr);
    }
}
