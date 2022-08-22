<?php

namespace App\Http\Controllers\Api\Designer;

use App\Bank_detail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use auth;
class BankController extends Controller
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
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }
        $input = $request->all();
        $rules = array(
            
            'account_no' => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'ifsc_code' => 'required',

        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            $bank_details=Bank_detail::where('user_id',auth::user()->id)->get()->first();
            $bank_details->account_no=$request->account_no;
            $bank_details->bank_name=$request->bank_name;
            $bank_details->branch_name=$request->branch_name;
            $bank_details->ifsc_code=$request->ifsc_code;
            $bank_details->update();
            $arr = array("status" => 200, "message" => 'Bank Details Updated', "bank_details" => $bank_details);

        }
        return response($arr);
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
