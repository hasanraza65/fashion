<?php

namespace App\Http\Controllers\Api\Designer;

use App\Extra;
use App\Fabric;
use App\Http\Controllers\Controller;
use App\Manufacturing_cost;
use Illuminate\Http\Request;
use auth;

class PreOrderController extends Controller
{
    public function preOrderData()
    {
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }
        $trims = Extra::all();
        $fabrics = Fabric::all();
        $styles = Manufacturing_cost::all();
        return response(['trims' => $trims, 'fabrics' => $fabrics, 'styles' => $styles]);
    }
}
