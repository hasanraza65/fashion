<?php

namespace App\Http\Controllers\Manufacturer;

use App\Bank_detail;
use App\Http\Controllers\Controller;
use App\Manufacturer_detail;
use App\Manufacturing_cost;
use App\User;
use Illuminate\Http\Request;
use Auth;
use File;
use Illuminate\Support\Facades\Storage;

class ManufacturerWebController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id != 3) 
        {
            return redirect(route('home'));
        }
        $title="Dashboard";
        return view('manufacturer.index',compact(['title']));
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
        if(Auth::user()->role_id != 3) 
        {
            return redirect(route('home'));
        }
        $users=User::find(Auth::user()->id);
        $title="Edit Profile";
        return view('manufacturer.edit',compact(['users','title']));
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
        if(Auth::user()->role_id != 3) 
        {
            return redirect(route('home'));
        }
        $user=User::find($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'phone' => 'required|size:10|unique:users,phone,'.$request->id,
            
        ]);

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
            $user->avatar = "https://lynfashion.s3.ap-south-1.amazonaws.com/" . $filePath1;
        }
        $manufacturer_details=Manufacturer_detail::where('user_id',$id)->get()->first();
        if ($file2 != '') {
            $request->validate([
                
                'adhar_image' =>  'image'
            ]);
            $image2 = $request->file('adhar_image');
            $imageName2 = time() . $image2->getClientOriginalName();
            $filePath2 = 'images/manufacturer/adhar/'. '/' . $imageName2;
            Storage::disk('s3')->put($filePath2, file_get_contents($image2));
            if ($manufacturer_details->adhar_pic->adhar_pic != null) {
                Storage::disk('s3')->delete(parse_url($manufacturer_details->adhar_pic->adhar_pic));
            $manufacturer_details->adhar_pic=  "https://lynfashion.s3.ap-south-1.amazonaws.com/".$filePath2;
            }
        }
        $manufacturer_details->adhar_no = $request->adhar_no;
        $manufacturer_details->update();
        $bank_details=Bank_detail::where('user_id',$id)->get()->first();
        $bank_details->bank_name=$request->bank_name;
        $bank_details->account_no=$request->account_no;
        $bank_details->branch_name=$request->branch_name;
        $bank_details->ifsc_code=$request->ifsc_code;
        $bank_details->update();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->update();
        $title="Home";
        session()->flash('success','Profile Updated Successfully');
        return redirect()->route('manufacturer-web.index',compact(['title']));
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
