<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Order_detail;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use auth;
class TransactionController extends Controller
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
        $transactions=Transaction::all();
        $title="Transaction List";
        return view('admin.transactionList',compact(['transactions','title']));
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
        $ord=0;
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
