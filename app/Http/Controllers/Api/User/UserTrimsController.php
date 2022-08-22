<?php

namespace App\Http\Controllers\Api\User;

use App\Extra;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserTrimsController extends Controller
{
    public function index()
    {
        $trims=Extra::all();
        return response($trims);

    }

    public function get($id)
    {
        $trim=Extra::find($id);
        return response($trim);
    }
}
