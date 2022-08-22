<?php

namespace App\Http\Controllers\Api\User;

use App\Banner;
use App\Catlog;
use App\Catlog_category;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use auth;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth() && Auth::user()->role_id != 4) {
            return response('unauthorized', 401);
        }
        $user = User::find(auth::user()->id);
        $banners = Banner::all();
        $catlog_categories = Catlog_category::all();
        $catlog_details = Catlog::all();
        return response(['user' => $user, 'banners' => $banners, 'catlog_categories' => $catlog_categories, 'catlogs' => $catlog_details]);
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
        if (Auth() && Auth::user()->role_id != 4) {
            return response('unauthorized', 401);
        }
        $lng = $request->lng;
        $lat = $request->lat;
        $circle_radius = 6371;
        $max_distance = 20;
        $designers = DB::select('SELECT * FROM
        (SELECT *, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(lat)) *
        cos(radians(lng) - radians(' . $lng . ')) +
        sin(radians(' . $lat . ')) * sin(radians(lat))))
        AS distance
        FROM designer_details) AS distances
        
        ORDER BY distance;

    ');
        return response($designers);
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
        if (Auth() && Auth::user()->role_id != 4) {
            return response('unauthorized', 401);
        }

        $input = $request->all();
        $rules = array(
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users,email,' . auth::user()->id,
            'phone' => 'required|unique:users,phone,' . auth::user()->id,
            'gender' => 'required',
            'address' => 'required',


        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            $user = User::find(auth::user()->id);
            $file = $request->file('image');
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
                $user->avatar = "https://lynfashion.s3.ap-south-1.amazonaws.com/" . $filePath1;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->update();


            $arr = array("status" => 200, "message" => 'Profile Updated', "user" => $user);
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
