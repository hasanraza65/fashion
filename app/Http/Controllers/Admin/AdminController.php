<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Dotenv\Result\Success;

use Illuminate\Support\Facades\Validator;
use File;
use auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{ 

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
        if(Auth::user()->is_admin == 0) 
        {
            return redirect(route('home'));
        }
        $admins=User::where('is_admin', '=',true)->get();
        $title="Home";
        return view('admin.index',compact(['admins','title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->is_admin == 0) 
        {
            return redirect(route('home'));
        }
        $title="Create Admin";
        return view('admin.create',compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            
           
        if(Auth::user()->is_admin == 0) 
        {
            return redirect(route('home'));
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users|digits:10',
            'password' => 'required|min:8',
        ]);

        $admin= new User;
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->phone=$request->phone;
        $admin->password=bcrypt($request->password);
        $admin->is_admin=1;
        $admin->save();
        $title="Home";
        session()->flash('success','Admin Created Successfully');
        return redirect()->route('admin.index',compact(['title']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(Auth::user()->is_admin == 0) 
        {
            return redirect(route('home'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->is_admin == 0) 
        {
            return redirect(route('home'));
        }
        $user=User::find($id);
        if(Auth::user()->id == $user->id)
        {
            $title="Edit Profile";
            return view('admin.edit')->with(['users'=>$user,'title'=>$title]);
        }
        else
        {
            $title="Home";
            return redirect(route('admin.index'))->with(['title'=>$title]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if(Auth::user()->is_admin == 0) 
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
        if ($file != '') {
            $request->validate([
                
                'image' =>  'image'
            ]);

            $image1 = $request->file('image');
            $imageName1 = time() . $image1->getClientOriginalName();
            $filePath1 = 'images/avatar/'. $imageName1;
            Storage::disk('s3')->put($filePath1, file_get_contents($image1));
            if ($user->avatar != null) {
                Storage::disk('s3')->delete(parse_url($user->avatar));
            }
            $user->avatar= "https://lynfashion.s3.ap-south-1.amazonaws.com/".$filePath1;
        }
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->update();
        $title="Home";
        session()->flash('success','Profile Updated Successfully');
        return redirect()->route('admin.index',compact(['title']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Auth::user()->is_admin == 0) 
        {
            return redirect(route('home'));
        }
    }
}
