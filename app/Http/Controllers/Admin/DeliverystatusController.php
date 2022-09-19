<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Auth;
use File;
use App\Product;
use App\EcomOrders;
use App\EcomOrderItems;
use App\User;
use Illuminate\Support\Facades\Storage;

use App\Deliverystatus;
use Illuminate\Http\Request;

class DeliverystatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if (Auth::user()->is_admin == 0) {
            return redirect(route('home'));
        }

      
        $deliverystatuses = new DeliveryStatus;
        $deliverystatuses->status = $request->delivery_status;
        $deliverystatuses->comment = $request->comment;
        $deliverystatuses->ecom_order_id = $request->orderid;
        $deliverystatuses->save();

        $order = EcomOrders::find($request->orderid);
        $order->delivery_status = $request->delivery_status;
        $order->update();

        session()->flash('success', ' Delivery Status Updated');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deliverystatus  $deliverystatus
     * @return \Illuminate\Http\Response
     */
    public function show(Deliverystatus $deliverystatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deliverystatus  $deliverystatus
     * @return \Illuminate\Http\Response
     */
    public function edit(Deliverystatus $deliverystatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deliverystatus  $deliverystatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deliverystatus $deliverystatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deliverystatus  $deliverystatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deliverystatus $deliverystatus)
    {
        //
    }
}
