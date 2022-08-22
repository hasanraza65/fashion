<?php

namespace App\Http\Controllers\Admin;

use App\Bank_detail;
use App\Http\Controllers\Controller;
use App\Manufacturer_detail;
use App\User;
use Illuminate\Http\Request;
use auth;
class ManufracturerController extends Controller
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
        
        if(Auth::user()->is_admin == 0) 
        {
            return redirect(route('home'));
        }
        $manufacturers=User::where('role_id',3)->get();
        $title="Manufacturer List";
        return view('admin.manufacturerList',compact(['manufacturers','title']));
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
        $title="Manufacturer Create";
        return view('admin.manufacturerCreate',compact(['title']));
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
            'percentage' => 'required',
        ]);
        $manufacturer= new User;
        $manufacturer->name=$request->name;
        $manufacturer->email=$request->email;
        $manufacturer->phone=$request->phone;
        $manufacturer->role_id=3;
        $manufacturer->password=bcrypt($request->password);
        $manufacturer->save();
        $manufacturer_details=new Manufacturer_detail;
        $manufacturer_details->user_id=$manufacturer->id;
        $manufacturer_details->percentage=$request->percentage;
        $manufacturer_details->save();
        $bank_details=new Bank_detail;
        $bank_details->user_id=$manufacturer->id;
        $bank_details->save();
        $title="Home";
        session()->flash('success','Manufacturer Created Successfully');
        return redirect()->route('manufacturer.index',compact(['title']));
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
        if(Auth::user()->is_admin == 0) 
        {
            return redirect(route('home'));
        }
        $manufacturer=User::find($id);
        $manufacturer->is_approved=false;
        $manufacturer->update();
        session()->flash('success','Manufacturer Disapproved Successfully');
        return redirect()->route('manufacturer.index');
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
        if(Auth::user()->is_admin == 0) 
        {
            return redirect(route('home'));
        }
        $manufacturer=User::find($id);
        $manufacturer->is_approved=true;
        $manufacturer->update();
        $manufacturer_details=Manufacturer_detail::where('user_id',$id)->get()->first();
        $manufacturer_details->percentage=$request->percentage;
        $manufacturer_details->update();
        session()->flash('success','Manufacturer Approved Successfully');
        return redirect()->route('manufacturer.index');
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
