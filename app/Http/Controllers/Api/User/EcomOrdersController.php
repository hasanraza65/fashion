<?php

namespace App\Http\Controllers\Api\User;

use App\EcomOrders;
use App\EcomOrderItems;
use App\Product;
use App\Deliverystatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use auth;

class EcomOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth()) {
            return response('unauthorized', 401);
        }

        $orders = EcomOrders::where('buyer_id', auth::user()->id)
        ->with('orderItems')
        ->with('orderBuyer')
        ->get();
       
        return response(['my_orders' => $orders]);
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

        if (!Auth()) {
            return response('unauthorized', 401);
        }

        $newitemqty = 0;

        $ecom_order = new EcomOrders;
        $ecom_order->buyer_id = Auth::user()->id;
        $ecom_order->save();


        $itemsarray = array();
        $itemsarray = $request->product_id;

       // return $request->order_item;

        //inserting order items to orders_items table 
        foreach($request->order_item as $itemsdata){

            //managing quantities stock
            $productid = $itemsdata['product_id'];
            $currentItem = Product::find($productid);
            $newitemqty = $currentItem->p_qty-$itemsdata['selected_qty'];

            if($newitemqty >= 0){
            $currentItem->p_qty = $newitemqty;
            $currentItem->update();
            }else{
            EcomOrders::find($ecom_order->id)->delete();
            return response(['order' => $ecom_order,'msg' => "You don't have enough quantity for ".$currentItem->name]);
            }
            //ending managing quantities stock

            $ecomorderitems = new EcomOrderItems;
            $ecomorderitems->product_id = $itemsdata['product_id'];
            $ecomorderitems->selected_qty = $itemsdata['selected_qty'];
            $ecomorderitems->price = $itemsdata['item_price'];
            $ecomorderitems->ecom_order_id = $ecom_order->id;
            $ecomorderitems->save();

        }
        //ending inserting items

            //add order delivery status  

            $deliverystatus = new Deliverystatus;
            $deliverystatus->status = "Ordered";
            $deliverystatus->comment = "Order has been placed";
            $deliverystatus->ecom_order_id = $ecom_order->id;
            $deliverystatus->save();
    
            //ending order derlivery status

        return response(['order' => $ecom_order,'msg' => "Order Placed"]);
    }

    public function fetchDeliveryStatus($id){

        $deliverystatus = DeliveryStatus::where('ecom_order_id', $id)->get();

        return response(['deliverystatuses' => $deliverystatus]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EcomOrders  $ecomOrders
     * @return \Illuminate\Http\Response
     */
    public function show(EcomOrders $ecomOrders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EcomOrders  $ecomOrders
     * @return \Illuminate\Http\Response
     */
    public function edit(EcomOrders $ecomOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EcomOrders  $ecomOrders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EcomOrders $ecomOrders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EcomOrders  $ecomOrders
     * @return \Illuminate\Http\Response
     */
    public function destroy(EcomOrders $ecomOrders)
    {
        //
    }

    public function paymentProcess(Request $request){

        $order = EcomOrders::find($request->orderid);
        $order->payment_status = "Paid";
        $order->razorpayid = $request->razorpayid;
        $order->update();


        $arr = array("status" => 200, "message" => 'Payment Status Upadated');

        return response($arr);

    }
}
