<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
use auth;  
class ChangePasswordController extends Controller
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
        $title="Change Password";
        if(auth::user()->is_admin)
        {
        $layout='admin';
        }
        else
        {
            $layout='manufacturer';

        }
        return view('changePassword',compact(['layout','title']));
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        $title="Home";
        session()->flash('success','Password changed Successfully');
        if(auth::user()->is_admin)
        {
            return redirect()->route('admin.index',compact(['title']));
        }
        else
        {
            return redirect()->route('manufacturer.index',compact(['title']));

        }
    }
}