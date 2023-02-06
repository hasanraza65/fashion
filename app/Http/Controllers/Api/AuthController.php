<?php

namespace App\Http\Controllers\API;

use App\Bank_detail;
use App\Designer_detail;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $input = $request->all();
        $rules = array(
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'phone' => 'required|unique:users',
            'role_id' => 'required',
            'gender' => 'required',
            'password' => 'required'
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            $input['password'] = bcrypt($request->password);
            if ($request->role_id == 4) {
                $user = User::create($input);
            } else {
                $user = User::create($input);
                $bank_details = new Bank_detail;
                $bank_details->user_id = $user->id;
                $bank_details->save();
                $designer_details = new Designer_detail;
                $designer_details->user_id = $user->id;
                $designer_details->save();
            }

            $accessToken = $user->createToken('authToken')->accessToken;


            $arr = array("status" => 200, "message" => 'user created','user' => $user, 'access_token' => $accessToken);

        }
        return \Response::json($arr);

    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials'], 401);
        }


        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        if (auth()->user()->role_id == 2) {
            return response(['user_type' => 'designer', 'user' => auth()->user(), 'access_token' => $accessToken]);
        } elseif (auth()->user()->role_id == 4) {
            return response(['user_type' => 'user', 'user' => auth()->user(), 'access_token' => $accessToken]);
        } else {
            return response('Service Not Avalabe');
        }
    }
    function changePassword(Request $request)
    {
        $data = $request->all();
        $user = Auth::guard('api')->user();

        //Changing the password only if is different of null
        if (isset($data['oldPassword']) && !empty($data['oldPassword']) && $data['oldPassword'] !== "" && $data['oldPassword'] !== 'undefined') {
            //checking the old password first
            $check  = Auth::guard('web')->attempt([
                'email' => $user->email,
                'password' => $data['oldPassword']
            ]);
            if ($check && isset($data['newPassword']) && !empty($data['newPassword']) && $data['newPassword'] !== "" && $data['newPassword'] !== 'undefined') {
                $user->password = bcrypt($data['newPassword']);
                $user->token()->revoke();
                $token = $user->createToken('newToken')->accessToken;

                //Changing the type
                $user->save();

                return json_encode(array('token' => $token)); //sending the new token
            } else {
                return response(['message' => 'Invalid Password'], 401);
            }
        }
        return response(['message' => 'Invalid Password'], 401);
    }

    public function forgot_password(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject($this->getEmailSubject());
                });

                //return $response;
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return \Response::json(array("status" => 200, "message" => trans($response), "data" => array()));
                    case Password::INVALID_USER:
                        return \Response::json(array("status" => 400, "message" => trans($response), "data" => array()));
                }
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        return \Response::json($arr);
    }

    public function socialLogin(Request $request){

        $user = User::where('social_id',$request->id)->first();

        if($user){

        $token = $user->createToken('newToken')->accessToken;

        $arr = array("status" => 200, "message" => 'Logged In','user' => $user, 'token' => $token);

        }else{

            $user = User::where('email',$request->email)->first();

            if($user){

                $user->social_id = $request->id;
                $user->update();

                $token = $user->createToken('newToken')->accessToken;

                $arr = array("status" => 200, "message" => 'Logged In','user' => $user, 'token' => $token);

            }else{

                $user = new User();
                $user->email = $request->email;
                $user->password = "password";
                $user->social_id = $request->id;
                $user->name = $request->name;
                $user->save();

                $token = $user->createToken('newToken')->accessToken;

                $arr = array("status" => 200, "message" => 'New User Created','user' => $user, 'token' => $token);

            }

            

        }

        return \Response::json($arr);

    }

    public function sendResetLink(Request $request){

            $credentials = request()->validate(['email' => 'required|email']);
    
            Password::sendResetLink($credentials);
    
            return response()->json(["msg" => 'Reset password link sent on your email id.']);

    }

    public function updateProfile(Request $request){

        $data = User::find(Auth::user()->id);

        //check if phone registered to another user
        $check_phone = User::where('phone',$request->phone)
        ->where('id','!=',Auth::user()->id)
        ->first();

        if($check_phone){
            return response()->json(["msg" => 'Error: Phone already registered with another account', "data"=>$data],401);
        }
        //ending check phone

        $data = $data->update($request->all());

        return response()->json(["msg" => 'Profile has been updated', "data"=>$data],200);


    }
}
