<?php

namespace Modules\Team\Http\Controllers;

use App\ApiConfig\ApiConfig;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\helper;

class TeamController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = Helper::getInstance();
    }
    public function viewTeams()
    {
        $apiUrl = ApiConfig::get('/team/getDetails');
        try {
            $response = $this->helper->postApiCallWithAuth('get', $apiUrl);
            if ($response['code'] === 200) {
                $responseData = $this->helper->responseHandler($response['data']);
                return view('team::view_teams')->with(["accounts" => $responseData]);
            } else {
                return view('team::view_teams')->with(["ErrorMessage" => 'Can not fetch accounts, please reload page']);
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $this->helper->logException($e, 'index() {Dashboardcontroller}');
            return view('home::UserDashboard')->with(["ErrorMessage" => 'Can not fetch accounts, please reload page']);
        }
        return view('team::view_teams');

    }

    public function teamView()
    {
        return view('team::view_particular_team');
    }

    public function createTeam()
    {
        return view('team::create_team');
    }
}
