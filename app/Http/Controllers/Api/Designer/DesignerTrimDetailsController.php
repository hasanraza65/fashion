<?php

namespace App\Http\Controllers\Api\Designer;

use App\Extra;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
class DesignerTrimDetailsController extends Controller
{
    public function trimsDetails($id)
    {
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }
        $trim_details=Extra::find($id);
        return response(['trim_details'=>$trim_details]);
    }
}
