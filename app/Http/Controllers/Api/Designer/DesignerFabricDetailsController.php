<?php

namespace App\Http\Controllers\Api\Designer;

use App\Fabric;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
class DesignerFabricDetailsController extends Controller
{
    public function fabricsDetails($id)
    {
            if (Auth() && Auth::user()->role_id != 2) {
                return response('unauthorized', 401);
            }
            $fabric_details=Fabric::find($id);
            return response(['fabric_details'=>$fabric_details]);
    }
}
