<?php

namespace App\Http\Controllers\Admin;

use App\Designer_detail;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use auth;

class DesignerController extends Controller
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
        $designers=User::where('role_id',2)->get();
        $title="Designer List";
        return view('admin.designerList',compact(['designers','title']));
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
        if(Auth::user()->is_admin == 0) 
        {
            return redirect(route('home'));
        }
        $designer=User::find($id);
        $designer->is_approved=false;
        $designer->update();
        session()->flash('success','Designer Disapproved Successfully');
        return redirect()->route('designer.index');
        
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
        $designer=User::find($id);
        $designer->is_approved=true;
        $designer->update();
        $designer_details=Designer_detail::where('user_id',$id)->get()->first();
        $designer_details->percentage=$request->percentage;
        $designer_details->update();
        session()->flash('success','Designer Approved Successfully');
        return redirect()->route('designer.index');
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
