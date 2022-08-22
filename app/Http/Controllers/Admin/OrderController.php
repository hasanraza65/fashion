<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Order_detail;
use App\User;
use Illuminate\Http\Request;
use auth;
class OrderController extends Controller
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
        $orders = Order::all();
        $title = "Order List";
        return view('admin.orderList', compact(['orders', 'title']));
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
        if (Auth::user()->is_admin == 0) {
            return redirect(route('home'));
        }
        $order = Order::find($id);
        $manufacturers=User::where('role_id',3)->get();
        $order_details = Order_detail::where('order_id',$id)->get()->first();
        $title = "Order Details";
        $ord=1;
        return view('admin.orderDetails', compact(['order','ord','order_details','manufacturers','title']));
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
        if (Auth::user()->is_admin == 0) {
            return redirect(route('home'));
        }
        $order=Order::find($id);
        $order_details=Order_detail::where('order_id',$id)->get()->first();
        $order->order_status='In Manufacturing';
        $order_details->manufacturer_id=$request->manufacturer_id;
        $order->update();
        $order_details->update();
        session()->flash('success','Manufacturer Assigned To Order Successfully');
        return redirect()->back();

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
