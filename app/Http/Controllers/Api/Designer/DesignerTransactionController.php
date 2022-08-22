<?php

namespace App\Http\Controllers\Api\Designer;

use App\Http\Controllers\Controller;
use App\Member_transaction;
use Illuminate\Http\Request;
use auth;

class DesignerTransactionController extends Controller
{
    public function myTransaction()
    {
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }
        $my_transactions=Member_transaction::where('user_id',auth::user()->id)->get();
        return response(['my_transactions'=>$my_transactions]);

    }
}
