<?php

namespace App\Http\Controllers\Api\User;

use App\Fabric;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserFabricsController extends Controller
{
    public function index()
    {
        $fabrics=Fabric::all();
        return response($fabrics);

    }

    public function get($id)
    {
        $fabric=Fabric::find($id);
        return response($fabric);
    }
}
