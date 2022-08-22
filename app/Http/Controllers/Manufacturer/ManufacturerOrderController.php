<?php

namespace App\Http\Controllers\Manufacturer;

use App\Http\Controllers\Controller;
use App\Order;
use App\Order_detail;
use Illuminate\Http\Request;
use auth;

class ManufacturerOrderController extends Controller
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

        $orders_list = Order_detail::where('manufacturer_id', auth::user()->id)->get();
        $title = "Order List";
        $ord=1;
        return view('manufacturer.orderList', compact(['orders_list','ord','title']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function view($id)
    {
        if (Auth::user()->role_id != 3) {
            return redirect(route('home'));
        }
        $order = Order::find($id);
        if ($order) {
            $order_details = Order_detail::where('order_id', $id)->get()->first();
            if ($order_details->manufacturer_id == auth::user()->id) {
                $title = "Order Details";
                return view('manufacturer.orderDetails', compact(['order', 'order_details', 'title']));
            }
        }
         else {
            return redirect(route('manufacturer-web.index'));
        }
    }

    public function edit($id)
    {
        $orders_list = Order_detail::where('manufacturer_id', auth::user()->id)->get();
        $title = "Order List";
        $ord=0;
        return view('manufacturer.orderList', compact(['orders_list','ord','title']));
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
        if (Auth::user()->role_id != 3) {
            return redirect(route('home'));
        }
        $order = Order::find($id);
        $order->order_status='Quality Assurance';
        $order->update();
        session()->flash('success','Order Status Set to Completed  Successfully');
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
