<?php

namespace App\Http\Controllers\Api\Designer;

use App\Http\Controllers\Controller;
use App\Manufacturing_cost;
use Illuminate\Http\Request;
use auth;
class DesignerManufacturingCostDetailsController extends Controller
{
    public function stylesDetails($id)
    {
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }
        $style_details=Manufacturing_cost::find($id);
        return response(['style_details'=>$style_details]);

    }
}
