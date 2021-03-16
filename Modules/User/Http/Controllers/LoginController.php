<?php

namespace Modules\User\Http\Controllers;

use App\Classes\AuthUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\User\Helper;


class LoginController extends Controller
{

    protected $API_URL;
    protected $helper;
    public $requestToken = "";
    public $requestSecret = "";

    public function __construct()
    {
        $this->API_URL = env('API_URL');
        $this->API_VERSION = env('API_VERSION');
        $this->helper = Helper::getInstance();
    }

    public function social($network)
    {
        if ($network == "Google" || $network == "Facebook" || $network == "Twitter" || $network == "GitHub") {
            try {
                $apiUrl = $this->API_URL . env('API_VERSION') . '/socialLogin?network=' . $network;
                try {
                    $response = $this->helper->postApiCall('GET', $apiUrl);
                    if ($response->code === 200) {
                        if ($network === "Twitter") {
                            $this->requestToken = $response->tokens->requestToken;
                            $this->requestSecret = $response->tokens->requestSecret;
                            Session::put("requestToken", $response->tokens->requestToken);
                            Session::put("requestSecret", $response->tokens->requestSecret);
                        }
                        return redirect($response->navigateUrl);
                    } else if ($response->code === 400) {
                        return redirect('login')->with('invalidSocial', $response->message);
                    }
                } catch (\GuzzleHttp\Exception\RequestException $e) {
                    $this->helper->logException($e, 'social() {LoginController}');
                    return redirect('login')->with('invalidSocial', 'Sorry some Error occured , Please reload the page');
                }
            } catch (\Exception $e) {
                $this->helper->logException($e, 'social() {LoginController}');
                return redirect('login')->with('invalidSocial', 'Sorry some Error occured , Please reload the page');
            }
        } else {
            return redirect('login')->with('invalidSocial', 'Sorry some Error occured , Please reload the page');
        }

    }

    public function facebookCallBack(Request $request)
    {
        try {
            $apiUrl = $this->API_URL . env('API_VERSION') . '/facebook-callback?code=' . $request['code'];
            try {
                $response = $this->helper->postApiCall('GET', $apiUrl);
                $user = array(
                    'userDetails' => (array)$response->data->user,
                    'accessToken' => $response->data->accessToken
                );
                Session::put('user', $user);

                if ($response->code === 200) {

                    return redirect()->route('dashboard');
                } else if ($response->code === 400) {
                    return redirect('login')->with('invalidSocial', $response['data']->message);
                } else {
                    return redirect('login')->with('invalidSocial', 'Sorry some Error occured , Please reload the page');
                }
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $this->helper->logException($e, ' facebookCallBack() {LoginController}');
                return redirect('login')->with('invalidSocial', 'Sorry some Error occured , Please reload the page');
            }
        } catch (\Exception $e) {
            $this->helper->logException($e, 'facebookCallBack() {LoginController}');
            return redirect('login')->with('invalidSocial', 'Sorry some Error occured , Please reload the page');
        }
    }

    public function googleCallBack(Request $request)
    {
        try {
            $apiUrl = $this->API_URL . env('API_VERSION') . '/google-callback?code=' . $request['code'];
            try {
                $response = $this->helper->postApiCall('GET', $apiUrl);
                if ($response->code === 200) {
                    $user = array(
                        'userDetails' => (array)$response->data->user,
                        'accessToken' => $response->data->accessToken
                    );
                    Session::put('user', $user);
                    return redirect('dashboard');
                } else if ($response->code === 400) {
                    return redirect('login')->with('invalidSocial', $response->message);
                } else {
                    return redirect('login')->with('invalidSocial', 'Sorry some Error occured , Please reload the page');
                }
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $this->helper->logException($e, ' googleCallBack() {LoginController}');
                return redirect('login')->with('invalidSocial', 'Sorry some Error occured , Please reload the page');
            }
        } catch (\Exception $e) {
            $this->helper->logException($e, 'googleCallBack() {LoginController}');
            return redirect('login')->with('invalidSocial', 'Sorry some Error occured , Please reload the page');
        }
    }

    public function gitHubCallBack(Request $request)
    {
        try {
            $apiUrl = $this->API_URL . env('API_VERSION') . '/github-callback?code=' . $request['code'];
            try {
                $response = $this->helper->postApiCall('GET', $apiUrl);
                if ($response->code === 200) {
                    $user = array(
                        'userDetails' => (array)$response->data->user,
                        'accessToken' => $response->data->accessToken
                    );
                    Session::put('user', $user);
                    return redirect('dashboard');
                } else if ($response->code === 400) {
                    return redirect('login')->with('invalidSocial', $response['data']->message);
                } else {
                    return redirect('login')->with('invalidSocial', 'Sorry some Error occured , Please reload the page');
                }
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $this->helper->logException($e, ' gitHubCallBack() {LoginController}');
                return redirect('login')->with('gitHubCallBack', 'Sorry some Error occured , Please reload the page');
            }
        } catch (\Exception $e) {
            $this->helper->logException($e, 'gitHubCallBack() {LoginController}');
            return redirect('login')->with('invalidSocial', 'Sorry some Error occured , Please reload the page');
        }
    }

    public function show(Request $request)
    {
        $apiUrl = $this->API_URL . env('API_VERSION') . '/login';

        if ($request->isMethod('get')) {
            if (Session::has('user')) {
                return view('home::Userdashboard');
            } else {
                return view("user::login");
            }
        } else if ($request->isMethod('post')) {
            $rules = array(
                "emailOrusername" => 'required',
                "password" => 'required'
            );
            try {

                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $validator->errors();
                } else {
                    if (str_contains($request->emailOrusername, '@')) {
                        $parameters = array(
                            "user" => $request->emailOrusername,
                            "password" => $request->password
                        );
                    } else {
                        $parameters = array(
                            "user" => $request->emailOrusername,
                            "password" => $request->password
                        );
                    }

                    try {
                         $response = $this->helper->postApiCall('post', $apiUrl, $parameters);
                    } catch (\GuzzleHttp\Exception\RequestException $e) {
                        $this->helper->logException($e, ' show() {LoginController}');
                        $result['code'] = 500;
                        $result['message'] = 'Sorry some Error occured , Please reload the page';
                        return $result;
                    }
                    if ($response['code'] == 200) {
                        $data = array(
                            'userDetails' => $response['user'],
                            'accessToken' => $response['accessToken']
                        );
                        Session::put('user', $data);
                        return $response;
                    } else if($response['code'] == 400){
                        return $response;
                    }else{
                        $result['code'] = 500;
                        $result['message'] = 'Sorry some Error occured , Please reload the page';
                        return $result;
                    }
                }
            } catch (\Exception $e) {
                $this->helper->logException($e, 'show() {LoginController}');
                $result['code'] = 500;
                $result['message'] = 'Sorry some Error occured , Please reload the page';
                return $result;
            }
        }
    }

    public function twitterCallBack(Request $request)
    {
        try {
            $requestToken = Session::get('requestToken');
            $requestSecret = Session::get('requestSecret');
            $apiUrl = $this->API_URL . env('API_VERSION') . '/twitter-callback?requestToken=' . $requestToken . '&requestSecret=' . $requestSecret . '&verifier=' . $request['oauth_verifier'];
            try {
                $response = $this->helper->postApiCall('GET', $apiUrl);
                if ($response->code === 200) {
                    $user = array(
                        'userDetails' => (array)$response->data->user,
                        'accessToken' => $response->data->accessToken
                    );
                    AuthUsers::login($user);
                    return redirect('dashboard');
                } else if ($response->code === 400) {
                    return redirect('login')->with('invalidSocial', $response['data']->message);
                } else {
                    return redirect('login')->with('invalidSocial', 'Sorry some Error occured , Please reload the page');
                }
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $this->helper->logException($e, ' twitterCallBack() {LoginController}');
                return redirect('login')->with('twitterCallBack', 'Sorry some Error occured , Please reload the page');
            }
        } catch (\Exception $e) {
            $this->helper->logException($e, 'twitterCallBack() {LoginController}');
            return redirect('login')->with('invalidSocial', 'Sorry some Error occured , Please reload the page');
        }
    }

    public function logout()
    {
        Session::flush();
        return Redirect::to('login');
    }

    public function forgotPassword()
    {
        return view("user::forgot_password");
    }

    public function resetPassword()
    {
        return view("user::reset_password");
    }

    public function forgotPasswordEmail(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'emailID' => 'required|email',
            ], [
                'emailID.required' => 'Email is required',
                'emailID.email' => 'Email invalid',
            ]);
            if ($validator->fails()) {
                $response['code'] = 201;
                $response['message'] = $validator->errors()->all();
                $response['data'] = null;
                return Response::json($response, 200);
            }
            $apiUrl = $this->API_URL . env('API_VERSION') . '/forgotPassword?email=' . $request->input("emailID");
            try {
                $response = $this->helper->postApiCall('get', $apiUrl);
                return $this->helper->responseHandler($response);
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                return $this->helper->guzzleErrorHandler($e, ' LoginController => forgotPasswordEmail => Method-get ');
            }
        } catch (\Exception $e) {
            return $this->helper->errorHandler($e, ' LoginController => forgotPasswordEmail => Method-get ');
        }
    }

    public function verifyPasswordToken(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'activationToken' => 'required'
            ], [
                'email.required' => 'Email is required',
                'email.email' => 'Invalid Email',
                'activationToken.required' => 'Activation Token required'
            ]);
            if ($validator->fails()) {
                $response['code'] = 201;
                $response['message'] = $validator->errors()->all();
                $response['data'] = null;
                return redirect("forgot-password")->with('message', $response["message"]);
            }
            $apiUrl = $this->API_URL . env('API_VERSION') . '/verifyPasswordToken?email=' . $request->input("email") . '&activationToken=' . $request->input("activationToken");
            try {
                $response = $this->helper->postApiCall('get', $apiUrl);
                $response = $this->helper->responseHandler($response);
                if ($response['code'] == 200) return redirect("reset-password")->with('email', $request->input("email"));
                else return redirect("forgot-password")->with('message', $response["message"]);
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $this->helper->logException($e, ' verifyPasswordToken() {LoginController}');
                return redirect('forgot-password')->with('message', 'Sorry some Error occured , Please reload the page');
            }
        } catch (\Exception $e) {
            $this->helper->logException($e, ' verifyPasswordToken() {LoginController}');
            return redirect('forgot-password')->with('message', 'Sorry some Error occured , Please reload the page');
        }
    }

    public function newPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "new_password" => 'required |regex:/^(?=.*\d)(?=.*[!-\/:-@\[-`{-~]).{8,}$/',
                "confirm_password" => 'required|same:new_password'
            ], [
                'new_password.required' => 'password is required',
                'new_password.regex' => 'Password must consist atleast 1 uppercase, 1 lowercase, 1 special character, 1 numeric value and minimum 8 charecters',
                'confirm_password.required' => 'confirm password is required',
                'confirm_password.same' => 'password mismatch',
            ]);
            if ($validator->fails()) {
                $response['code'] = 201;
                $response['message'] = $validator->errors()->all();
                $response['data'] = null;
                return Response::json($response, 200);
            }
            $apiUrl = $this->API_URL . env('API_VERSION') . '/resetPassword?email=' . $request->input("email") . '&newPassword=' . $request->input("new_password");
            try {
                $response = $this->helper->postApiCall('post', $apiUrl);
                return $this->helper->responseHandlerwithArray($response);
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                return $this->helper->guzzleErrorHandler($e, ' LoginController => newPassword => Method-post ');
            }
        } catch (\Exception $e) {
            return $this->helper->errorHandler($e, ' LoginController => newPassword => Method-post ');
        }
    }

    public function emailLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'emailID' => 'required|email',
            ], [
                'emailID.required' => 'Email is required',
                'emailID.email' => 'Invalid Email',
            ]);
            if ($validator->fails()) {
                $response['code'] = 201;
                $response['message'] = $validator->errors()->all();
                $response['data'] = null;
                return Response::json($response, 200);
            }
            $apiUrl = $this->API_URL . env('API_VERSION') . '/directLoginMail?email=' . $request->input("emailID");
            try {
                $response = $this->helper->postApiCall('get', $apiUrl);
                return $this->helper->responseHandler($response);
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                return $this->helper->guzzleErrorHandler($e, ' LoginController => emailLogin => Method-get ');
            }
        } catch (\Exception $e) {
            return $this->helper->errorHandler($e, ' LoginController => emailLogin => Method-get ');
        }
    }

    public function verifyDirectLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'activationToken' => 'required'
            ], [
                'email.required' => 'Email is required',
                'email.email' => 'Invalid Email',
                'activationToken.required' => 'Activation Token required'
            ]);
            if ($validator->fails()) {
                $response['code'] = 201;
                $response['message'] = $validator->errors()->all();
                $response['data'] = null;
                return redirect("forgot-password")->with('message', $response["message"]);
            }
            $apiUrl = $this->API_URL . env('API_VERSION') . '/verifyDirectLoginToken?email=' . $request->input("email") . '&activationToken=' . $request->input("activationToken");
            try {
                $response = $this->helper->postApiCall('get', $apiUrl);
                $response = $this->helper->responseHandler($response);
                if ($response['code'] == 200) {
                    $data['email'] = $request->input("email");
                    $this->directLogin($data);
                    return redirect()->route('dashboard');
//                    return view('home::Userdashboard');
                } else return view('user::login', ['result' => $response['message'], 'code' => $response['code']]);

            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $this->helper->logException($e, ' verifyDirectLogin() {LoginController}');
                return view('user::login', ['result' => 'Sorry some Error occured , Please reload the page', 'code' => 403]);
            }
        } catch (\Exception $e) {
            $this->helper->logException($e, ' verifyDirectLogin() {LoginController}');
            return view('user::login', ['result' => 'Sorry some Error occured , Please reload the page', 'code' => 500]);
        }
    }

    public function directLogin($email)
    {
        try {
            $validator = Validator::make($email, [
                'email' => 'required|email',
            ], [
                'email.required' => 'Email is required',
                'email.email' => 'Invalid Email',
            ]);
            if ($validator->fails()) {
                $response['code'] = 201;
                $response['message'] = $validator->errors()->all();
                $response['data'] = null;
                return Response::json($response, 200);
            }
            $apiUrl = $this->API_URL . env('API_VERSION') . '/directLogin';
            try {
                $response = $this->helper->postApiCall('post', $apiUrl, $email);
                if ($response['code'] == 200) {
                    $data = array(
                        'user' => $response['user'],
                        'accessToken' => $response['accessToken']
                    );
                    Session::put('user', $data);
                    return;
                } else  return view('user::login', ['result' => $response['message'], 'code' => $response['code']]);
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $this->helper->logException($e, ' directLogin() {LoginController}');
                return redirect('login')->with('directLogin', 'Sorry some Error occured , Please reload the page');
            }
        } catch (\Exception $e) {
            $this->helper->logException($e, ' directLogin() {LoginController}');
            return view('user::login', ['result' => 'Sorry some Error occured , Please reload the page', 'code' => 500]);
        }
    }

}
