<?php

namespace App\Http\Controllers\Api\Designer;

use App\Bank_detail;
use App\Banner;
use App\Catlog;
use App\Catlog_category;
use App\Designer_detail;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;
use auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
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
        $designer = array_merge(User::find(auth::user()->id)->toArray(), Designer_detail::where('user_id', auth::user()->id)->get()->first()->toArray());
        $bank_details = Bank_detail::where('user_id', auth::user()->id)->get()->first();
        $banners = Banner::all();
        $catlog_categories = Catlog_category::all();
        $catlog_details = Catlog::all();

        return response(['designer_details' => $designer, 'banners' => $banners, 'bank_details' => $bank_details, 'catlog_categories' => $catlog_categories, 'catlogs' => $catlog_details]);
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
        //
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
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users,email,' . auth::user()->id,
            'phone' => 'required|unique:users,phone,' . auth::user()->id,
            'gender' => 'required',
            'address' => 'required',
            'title_tag' => 'required',
            'description' => 'required',
            'adhar_no' => 'required',
            'lat' => 'required',
            'lng' => 'required',

        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            $user = User::find(auth::user()->id);
            $designer_details = Designer_detail::where('user_id', auth::user()->id)->get()->first();
            $file = $request->file('image');
            $file2 = $request->file('adhar_image');
            if ($file != '') {
                $request->validate([
                    'image' =>  'image'
                ]);
                $image1 = $request->file('image');
                $imageName1 = time() . $image1->getClientOriginalName();
                $filePath1 = 'images/avatar' . '/' . $imageName1;
                Storage::disk('s3')->put($filePath1, file_get_contents($image1));
                if ($user->avatar != null) {
                    Storage::disk('s3')->delete(parse_url($user->avatar));
                }
                $user->avatar =  $filePath1;
            }
            if ($file2 != '') {
                $request->validate([
                    'adhar_image' =>  'image'
                ]);
                $image2 = $request->file('adhar_image');
                $imageName2 = time() . $image2->getClientOriginalName();
                $filePath2 = 'images/designer/adhar/' . '/' . $imageName2;
                Storage::disk('s3')->put($filePath2, file_get_contents($image2));
                if ($designer_details->adhar_pic != null) {
                    Storage::disk('s3')->delete(parse_url($designer_details->adhar_pic));
                }
                $designer_details->adhar_pic =  $filePath2;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->update();

            $designer_details->title_tag = $request->title_tag;
            $designer_details->description = $request->description;
            $designer_details->adhar_no = $request->adhar_no;
            $designer_details->lat = $request->lat;
            $designer_details->lng = $request->lng;
            $designer_details->update();
            $designer_detail = array_merge($user->toArray(), $designer_details->toArray());
            $arr = array("status" => 200, "message" => 'Profile Updated', "designer_details" => $designer_detail);
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
        //
    }
}
