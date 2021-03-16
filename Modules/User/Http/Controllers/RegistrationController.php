<?php

namespace Modules\User\Http\Controllers;

use App\ApiConfig\ApiConfig;
use App\Traits\RegisterUser;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Client\Response;
use Modules\User\helper;


class RegistrationController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = Helper::getInstance();
    }



    public function show(Request $requestFields)
    {
        if ($requestFields->isMethod('get')){
            return view("user::sign_up");
        }else if ($requestFields->isMethod('post')){
            if (isset($requestFields->agree)){
                $rules = array(
                    "firstName" => 'required|max:32|min:2|regex:/^[a-zA-Z0-9-_]*$/',
                    "lastname" => 'required|max:32|min:1|regex:/^[a-zA-Z0-9-_]*$/',
                    "username" => 'required|regex:/([a-zA-Z]+)([0-9]*)/',
                    "email" => 'required|email',
                    "password" => 'required|max:20|min:6|regex:/^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])(?=.*[\/!@#$%^&*()`~\s_+\-=\[\]{};:"\\\,.<>\?\']).*$/',
                    "password_confirmation" => 'required_with:password|same:password',
                );

                $customMessage =[
                    'password.regex' => 'Password must consist atleast 1 uppercase, 1 lowercase and 1 special character and i numeric value',
                    'password_confirmation.required_with' =>'Please confirm your password!',
                    'password_confirmation.same'=>'Password missmatch',
                    'username.regex' =>'Username should be alphanumeric',
                    'firstName.regex' => 'First Name should not contain special characters.',
                    'lastname.regex' => 'Last Name should not contain special characters.'
                ];

                    $apiUrl = ApiConfig::get('/register');
                    $validator = Validator::make($requestFields->all(), $rules, $customMessage);

                    if ($validator->fails()) {
                        return $validator->errors();
                    }
                try {
                    $parameters = array(
                        'user' => array(
                            'userName' => $requestFields->username,
                            'email' => $requestFields->email,
                            'password' => $requestFields->password,
                            'firstName' => $requestFields->firstName,
                            'lastName' => $requestFields->lastname,
                            )
                    );
                    try {
                        $response = $this->helper->postApiCall('put', $apiUrl, $parameters);
                    } catch (\GuzzleHttp\Exception\RequestException $e){
                        $this->helper->logException($e, ' show() {RegistrationController}');
                        $result['code'] = 500;
                        $result['message'] = 'Sorry some Error occured , Please reload the page';
                        return $result;
                    }
                    if ($response['code'] == 200) {
//                        $data = $this->helper->responseHandler($response);
                        return $this->helper->responseHandlerwithArray($response);

                    }else {
                        $result['code'] = 500;
                        $result['message'] = 'Sorry some Error occured , Please reload the page';
                        return $result;
                    }
                }catch (\Exception $e){
                    $this->helper->logException($e, ' show() {RegistrationController}');
                    $result['code'] = 500;
                    $result['message'] = 'Sorry some Error occured , Please reload the page';
                    return $result;
                }

            }else{
                $res['error'] = "Please check the terms and conditions!!";
                return $res;
            }
        }
    }

    public function verify(Request $request){
        $apiUrl = ApiConfig::get('/verifyEmail');
        $email = $request['email'];
        $activationToken = $request['activationToken'];

        try {
            $response = $this->helper->postApiCall('get', $apiUrl.'?email='.$email.'&activationToken='.$activationToken, $data=null);

            if($response->code == 200){
                return view('user::login',['result' => $response->message, 'code' => 200]);
            }else {
                return view('user::login',['result' =>$response->message, 'code' => 400]);
            }
        }catch (\GuzzleHttp\Exception\RequestException $e){

        }
    }

}
