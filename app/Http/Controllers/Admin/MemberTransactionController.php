<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Member_transaction;
use Illuminate\Http\Request;
use auth;
class MemberTransactionController extends Controller
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
        if(Auth::user()->is_admin == 0) 
        {
            return redirect(route('home'));
        }
        $member_transactions=Member_transaction::all();
        $title="Member Transaction List";
        return view('admin.memberTransactionList',compact(['member_transactions','title']));
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
        $member_transaction=Member_transaction::find($id);
        $member_transaction->status='Paid';
        $member_transaction->update();
        session()->flash('success','Transaction Status Paid Successfully');
        return redirect()->route('member_transaction.index');
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
