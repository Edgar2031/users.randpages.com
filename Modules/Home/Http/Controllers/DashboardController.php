<?php

namespace Modules\Home\Http\Controllers;

use App\ApiConfig\ApiConfig;
use App\Models\User;
use App\Traits\RegisterUser;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\User\helper;

class DashboardController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = Helper::getInstance();
    }

    public function index()
    {
        try {
            $apiUrl = ApiConfig::get('/team/getDetails');
            try {
                $response = $this->helper->postApiCallWithAuth('get', $apiUrl);
                if ($response['code'] === 200) {
                    $responseData = $this->helper->responseHandler($response['data']);
                    return view('home::UserDashboard')->with(["accounts" => $responseData]);
                } else {
                    return view('home::UserDashboard')->with(["ErrorMessage" => 'Can not fetch accounts, please reload page']);
                }
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $this->helper->logException($e, 'index() {Dashboardcontroller}');
                return view('home::UserDashboard')->with(["ErrorMessage" => 'Can not fetch accounts, please reload page']);
            }

        } catch (\Exception $e) {
            $this->helper->logException($e, 'index() {Dashboardcontroller}');
            return view('home::UserDashboard')->with(["ErrorMessage" => 'Can not fetch accounts, please reload page']);
        }
    }

    public function create(RegistrationRequest $requestFields)
    {
        $user = $this->registerUser($requestFields);
        return back();
    }

    public function lockAccount($id)
    {
        try {
            $apiUrl = ApiConfig::get('/team/lockProfiles');
            $parameters = [$id];
            $response = $this->helper->postApiCallWithAuth('put', $apiUrl, $parameters);
            if ($response['statusCode'] == 200) {
                return $this->helper->responseHandlerApi($response);
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {

        }
    }

    public function unlockAccount($id)
    {
        try {
            $apiUrl = ApiConfig::get('/team/unlockProfiles');
            $parameters = [$id];
            $response = $this->helper->postApiCallWithAuth('put', $apiUrl, $parameters);
            if ($response['statusCode'] == 200) {
                $result = $this->helper->responseHandlerApi($response);
                return $result;
            }
        } catch (\Exception $e) {

        }
    }

    public function getSocialAccountsDetails()
    {
        try {
            try {
                $apiUrl = ApiConfig::get('/team/getDetails');
                $response = $this->helper->postApiCallWithAuth('get', $apiUrl);
                return view('home::Accounts.accounts')->with(["accounts" => $response["data"]]);
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $this->helper->logException($e, 'getSocialAccountsDetails() {Dashboardcontroller}');
                return view('home::Accounts.accounts')->with(["ErrorMessage" => 'Can not fetch accounts, please reload page']);
            }
        } catch (\Exception $e) {
            $this->helper->logException($e, 'getSocialAccountsDetails() {Dashboardcontroller}');
            return view('home::Accounts.accounts')->with(["ErrorMessage" => 'Can not fetch accounts, please reload page']);
        }
    }

    public function addSocialAccounts($network)
    {
        $teamid = 0;
        $teamid = ($this->helper->getTeamNewSession())['teamid'];
        if ($teamid !== 0) {
            try {
                $apiUrl = ApiConfig::get('/team/getProfileRedirectUrl?teamId=' . $teamid . '&network=' . $network);
                $response = $this->helper->postApiCallWithAuth('get', $apiUrl);
                if ($response['code'] === 200) {
                    session::put('state', $response['data']->state);
                    if ($network !== 'Twitter') {
                        return redirect($response['data']->navigateUrl);
                    } else {
                        return redirect($response['data']->redirectUrl);
                    }
                } elseif ($response['code'] === 403) {
                    return redirect('dashboard')->with("failed", $response['data']->redirectUrl);

                } else {
                    return redirect('dashboard')->with("failed", 'Some Error Occured please,reload the page');
                }
            } catch (\Exception $e) {
                $this->helper->logException($e, 'addSocialAccounts() {Dashboardcontroller}');
                return redirect('dashboard')->with("failed", 'Some Error Occured please,reload the page');
            }
        } else {
            return redirect('dashboard')->with("failed", 'No team found for this User');
        }

    }


    public function addTwitterCallback(Request $request)
    {
        $state = session::get('state');
        try {
            $apiUrl = ApiConfig::get('/team/addSocialProfile?state=' . $state . '&code=' . $request['oauth_verifier']);
            $response = $this->helper->postApiCallWithAuth('get', $apiUrl);
            return redirect('dashboard');
        } catch (\Exception $e) {
            return redirect('dashboard')->with(["Errormessage" => 'Some Error Occured please,reload the page']);
        }

    }

    public function addfacebookCallback(Request $request)
    {
        $state = session::get('state');
        try {
            $apiUrl = ApiConfig::get('/team/addSocialProfile?state=' . $state . '&code=' . $request['code']);
            $response = $this->helper->postApiCallWithAuth('get', $apiUrl);
            if ($response['data']->code === 200) {
                return redirect('dashboard')->with(["success" => 'Added Account Successfully']);
            } else if ($response['data']->code === 403) {
                return redirect('dashboard')->with(["Errormessage" => $response['data']->message]);
            } else {
                return redirect('dashboard')->with(["Errormessage" => 'Some Error Occured please,reload the page']);
            }

        } catch (\Exception $e) {
            return redirect('dashboard')->with(["Errormessage" => 'Some Error Occured please,reload the page']);
        }

    }

    public function addLinkedInCallback(Request $request)
    {
        $state = session::get('state');
        try {
            $apiUrl = ApiConfig::get('/team/addSocialProfile?state=' . $state . '&code=' . $request['code']);
            $response = $this->helper->postApiCallWithAuth('get', $apiUrl);
            return redirect('dashboard');
        } catch (\Exception $e) {
            return redirect('dashboard')->with(["Errormessage" => 'Some Error Occured please,reload the page']);
        }

    }


    public function updateRating(Request $request)
    {
        $api_url = ApiConfig::get('/team/updateRatings?accountId=' . $request->accountId . '&rating=' . $request->rating);
        $method = "PUT";
        $data = ($request->all());
        try {
            $response = $this->helper->postApiCallWithAuth($method, $api_url, $data);
            return $response["data"];
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $this->helper->guzzleErrorHandler($e, ' UserController => get_pages => Method-post ');
        }
    }

    public function updateCron(Request $request)
    {
        $api_url = ApiConfig::get('/team/updateFeedsCron?accountId=' . $request->accountId . '&cronvalue=' . $request->cronvalue);
        $method = "PUT";
        $data = ($request->all());
        try {
            $response = $this->helper->postApiCallWithAuth($method, $api_url, $data);
            return $response["data"];
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return $this->helper->guzzleErrorHandler($e, ' UserController => get_pages => Method-post ');
        }
    }
}
