<?php

namespace App\Http\Controllers\Api\User;

use App\Extra_order;
use App\Fabric_order;
use App\Http\Controllers\Controller;
use App\Order;
use App\Order_detail;
use Illuminate\Http\Request;
use auth;

class UserOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::all();
        return response($orders);
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
        $order = new Order;
        $order->razorpay_id = $request->razorpay_id;
        $order->user_id = Auth::user()->id;
        $order->designer_id = $request->designer_id;
        $order->no_of_peice = $request->no_of_peice;
        $order->fabric_id = $request->fabric_id;
        $order->amount = $request->amount;
        $order->order_status = "In Designing";
        $order->save();

        $order_details = new Order_detail;
        $order_details->order_id = $order->id;
        $order_details->fabric_id = $request->fabric_id;
        $order_details->manufacturing_cost_id = $request->manufacturing_cost_id;
        $order_details->no_of_peice = $request->no_of_peice;
        $order_details->save();

        if ($request->fabric_orders) {
            $fabric_orders = $request->fabric_orders;

            foreach ($fabric_orders as $fabric_order) {
                // $fabric_id[]=$fabric_order['fabric_id'];
                // $used_for[]=$fabric_order['used_for'];
                $extra_order_fabrics = new Fabric_order;
                $extra_order_fabrics->order_id = $order->id;
                $extra_order_fabrics->fabric_id = $fabric_order['fabric_id'];
                $extra_order_fabrics->used_for = $fabric_order['used_for'];
                $extra_order_fabrics->save();
            }
        }


        if ($request->extra_orders) {
            $extra_orders = $request->extra_orders;

            foreach ($extra_orders as $extra_order) {
                // $fabric_id[]=$fabric_order['fabric_id'];
                // $used_for[]=$fabric_order['used_for'];
                $extra_order_extra = new Extra_order;
                $extra_order_extra->order_id = $order->id;
                $extra_order_extra->extra_id = $extra_order['extra_id'];
                $extra_order_extra->quantity = $extra_order['quantity'];
                $extra_order_extra->total_amount = $extra_order['total_amount'];
                $extra_order_extra->save();
            }
        }

        return response(['order' => $order,'msg' => "Order Placed"]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::find($id);
        $order_details=Order_detail::where('order_id',$id)->get();
        $fabric_order=Fabric_order::where('order_id',$id)->get();
        $extra_order=Extra_order::where('order_id',$id)->get();

        return response(['order' => $order,'fabric_order' => $fabric_order,'extra_order' => $extra_order]);

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
        //
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
