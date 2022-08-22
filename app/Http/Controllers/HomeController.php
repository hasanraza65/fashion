<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->is_admin == 1) 
        {
            return redirect(route('admin.index'));
        }
        elseif(Auth::user()->role_id == 3)
        {
            return redirect(route('manufacturer-web.index'));

        }
        else
        {
        return view('home');
        }
    }
}
