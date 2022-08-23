<?php

namespace App\Http\Controllers\Api\User;

use App\EcomOrderItems;
use Illuminate\Http\Request;
use App\EcomOrders;
use App\Http\Controllers\Controller;
use auth;

class EcomOrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!Auth()) {
        
            return response('unauthorized', 401);
        }

        $orderid = $request->orderid;
    
        $order_items = EcomOrderItems::where('ecom_order_id', $orderid)
        ->with('itemData')
        ->get();
       
        return response(['item_data' => $order_items]);

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
     * @param  \App\EcomOrder_Items  $ecomOrder_Items
     * @return \Illuminate\Http\Response
     */
    public function show(EcomOrder_Items $ecomOrder_Items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EcomOrder_Items  $ecomOrder_Items
     * @return \Illuminate\Http\Response
     */
    public function edit(EcomOrder_Items $ecomOrder_Items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EcomOrder_Items  $ecomOrder_Items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EcomOrder_Items $ecomOrder_Items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EcomOrder_Items  $ecomOrder_Items
     * @return \Illuminate\Http\Response
     */
    public function destroy(EcomOrder_Items $ecomOrder_Items)
    {
        //
    }
}
