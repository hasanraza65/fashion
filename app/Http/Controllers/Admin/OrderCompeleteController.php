<?php

namespace App\Http\Controllers\Admin;

use App\Designer_detail;
use App\Http\Controllers\Controller;
use App\Manufacturer_detail;
use App\Member_transaction;
use App\Order;
use App\Order_detail;
use App\User;
use Illuminate\Http\Request;
use auth;
class OrderCompeleteController extends Controller
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
        if(Auth::user()->is_admin == 0) 
        {
            return redirect(route('home'));
        }
        $order=Order::find($id);
        $order->order_status='Compeleted';
        $order->update();
        $order_details=Order_detail::where('order_id',$id)->get()->first();
        $manufacturer=User::find($order_details->manufacturer_id);
        $manufacturer_details=Manufacturer_detail::where('user_id',$manufacturer->id)->get()->first();
        $designer=User::find($order->designer_id);
        $designer_details=Designer_detail::where('user_id',$designer->id)->get()->first();
        $manufacturer_share=$order->amount*$manufacturer_details->percentage/100;
        $designer_share=$order->amount*$designer_details->percentage/100;

        $member_transaction_manufacturer=new Member_transaction;
        $member_transaction_manufacturer->user_id=$manufacturer->id;
        $member_transaction_manufacturer->order_id=$id;
        $member_transaction_manufacturer->amount=$manufacturer_share;
        $member_transaction_manufacturer->save();

        $member_transaction_designer=new Member_transaction;
        $member_transaction_designer->user_id=$designer->id;
        $member_transaction_designer->order_id=$id;
        $member_transaction_designer->amount=$designer_share;
        $member_transaction_designer->save();

        session()->flash('success','Order Status Changed  Successfully');
        return redirect()->back();
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
