<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\UserOTP;
use App\User;
use Illuminate\Http\Request;

class UserOTPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserOTP  $userOTP
     * @return \Illuminate\Http\Response
     */
    public function show(UserOTP $userOTP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserOTP  $userOTP
     * @return \Illuminate\Http\Response
     */
    public function edit(UserOTP $userOTP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserOTP  $userOTP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserOTP $userOTP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserOTP  $userOTP
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserOTP $userOTP)
    {
        //
    }

    public function sendOTP(Request $request){

        $username = 'lynsler';
        $password = 'lynsler';
        $contacts = $request->phone_num;
        $from = 'LYNSLR';
        
        $template_id = '1507166313386253989';
        $pe_id = '1501416580000052189';


        //generate OTP
    	if($request->phone_num != '0011223344'){
        $otp = rand(1000000,10);
        }else{
        $otp = 123456;
        }
        $sms_text = urlencode('Your OTP is '.$otp.'.Thanks, Team Lynsler');

        //check if otp available already
        $check_otp = UserOTP::where('phone_num',$request->phone_num)
        ->orWhere('email',$request->email)
        ->first();
        if($check_otp){
        $check_otp->delete();
        }
        //ending check if otp available already

        $store_otp = new UserOTP();
        $store_otp->phone_num = $request->phone_num;
        $store_otp->email = $request->email;
        $store_otp->otp = $otp;
        $store_otp->save();
        //ending generate OTP

        //Submit to server

        $fields = array(
            'username' => $username,
            'password' => $password,
            'campaign' => '13596',
            'routeid' => 7,
            'type' => 'text',
            'contacts' => $contacts,
            'senderid' => $from,
            'msg' => $sms_text,
            'template_id' => $template_id,
            'pe_id' => $pe_id
            
        );

        //url-ify the data for the POST

        if($request->phone_num != "" && $request->phone_num != null){

        $fields_string = http_build_query($fields);

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, "http://sms.infikeytech.com/app/smsapi/index.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        $response = curl_exec($ch);
        curl_close($ch);
        //echo $response;

        }else{
            $email = $request->email;

             $content = 'Your OTP is '.$otp;
             $response = Mail::raw("", function ($message) use ($email,$otp,$content) {
                $body = new \Symfony\Component\Mime\Part\TextPart($content);
                $message->to($email)
                    ->subject('Your OTP is '.$otp)
                    ->from("noreply@muckypawskennels.co.uk")
                    ->setBody($body);
            });


           //$response = "OTP sent on email"; 

        }



        return response(['message'=>'OTP Sent.','data'=>$response],200);
    }

    public function verifyOTP(Request $request){

        $phone_num = $request->phone_num;
        $otp = $request->otp;
        $email = $request->email;
        if($email == "" && $email == null){
            $email = $request->phone_num.'@mail.com';
        }
        $name = $request->name;
        $password = "password";

        $checkOTP = UserOTP::where('phone_num', $phone_num)->get();

        if(count($checkOTP) == 0){

        return response(['message'=>'Error: OTP Not Available or Expired'],200);

        }

        foreach($checkOTP as $data){

            if($otp != $data->otp){

            return response(['message'=>'Error: OTP Mismatched'],200);

            }else if($otp == $data->otp){

                //find user id
                if($phone_num != "" && $phone_num != null){
                $user = User::where('phone', $phone_num)
                ->first();
                }else if($email != "" && $email != null){
                $user = User::where('email', $email)
                ->first();
                }

                if($user){

                $token = $user->createToken('LaravelAuthApp')->accessToken;
                //ending find user id
                }else{
                    
                    $user = new User();
                    $user->email = $email;
                    $user->phone = $phone_num;
                    $user->name = $name;
                    $user->password = bcrypt($password);
                    $user->save();

                    $token = $user->createToken('LaravelAuthApp')->accessToken;

                }

                //delete otp
               
                $check_otp = UserOTP::where('phone_num',$request->phone_num)
                ->orWhere('email', $email)
                ->first();
                $check_otp->delete();
         
                //delete otp

                
                return response(['message'=>'OTP Verification Completed Successfully!', 'token' => $token, 'user'=>$user],200);

            }

        }
        

    }
}
