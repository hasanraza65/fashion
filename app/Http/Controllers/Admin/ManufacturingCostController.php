<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Manufacturing_cost;
use Illuminate\Http\Request;
use auth;
class ManufacturingCostController extends Controller
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
        $manufacturing_costs = Manufacturing_cost::all();
        $title = "Style List";
        return view('admin.manufacturingCostList', compact(['manufacturing_costs', 'title']));
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
        $title = "Style Create";
        return view('admin.manufacturingCostCreate', compact(['title']));
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
            'style_name' => 'required|unique:manufacturing_costs',
            'style_no' => 'required|unique:manufacturing_costs',
            'manufacturing_cost' => 'required',
        ]);
        
        $manufacturing_cost = new Manufacturing_cost;
        $manufacturing_cost->style_name = $request->style_name;
        $manufacturing_cost->style_no = $request->style_no;
        $manufacturing_cost->manufacturing_cost = $request->manufacturing_cost;
        $manufacturing_cost->save();
        session()->flash('success', 'Style Added Successfully');
        return redirect()->route('manufacturing_cost.index');
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
        $manufacturing_cost = manufacturing_cost::find($id);
        $title = "Style Edit";
        return view('admin.manufacturingCostEdit', compact(['manufacturing_cost', 'title']));
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

        $request->validate([
            'style_name' => 'required|unique:manufacturing_costs,style_name,' . $id,
            'style_no' => 'required|unique:manufacturing_costs,style_no,' . $id,
            'manufacturing_cost' => 'required',
        ]);
        
        $manufacturing_cost =Manufacturing_cost::find($id);
        $manufacturing_cost->style_name = $request->style_name;
        $manufacturing_cost->style_no = $request->style_no;
        $manufacturing_cost->manufacturing_cost = $request->manufacturing_cost;
        $manufacturing_cost->update();
        session()->flash('success', 'Style Updated Successfully');
        return redirect()->route('manufacturing_cost.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufacturing_cost=Manufacturing_cost::find($id);
        session()->flash('success', 'Style Deleted Successfully');
        $manufacturing_cost->delete();


        return redirect()->route('manufacturing_cost.index');
    }
}
