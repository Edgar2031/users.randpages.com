<?php

namespace Modules\User;

use App\ApiConfig\ApiConfig;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Session;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Log;

class helper
{
    protected $client;
    public $token;
    private static $instance;
    protected $helper;

    private function __construct()
    {
        $this->client = new Client();
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new helper();
        }
        return self::$instance;
    }


    public function postApiCallWithAuth($method, $api_url, $data = null, $is_multipart = false) //for authorized APIS which are requiring Access token
    {

        $this->token = Session::get('user')['accessToken'];
        switch (strtolower($method)) {
            case "get":
                $result = [];
                try {
                    $response = $this->client->get($api_url, [
                        'headers' => ['x-access-token' => $this->token],
                    ]);
                    $responseBody = json_decode($response->getBody()->getContents());
                    $result['code'] = $response->getStatusCode();
                    $result['data'] = $responseBody;
                    return $result;
                } catch (Exception $e) {
                    $response->code = 400;
                    $response->message = $e->getMessage();
                    return $response;
                }
                break;
            case "post":
                $result = [];
                $response = null;
                try {
                    if ($is_multipart) {
                        $response = $this->client->request('POST', $api_url, [
                            'multipart' => [
                                [
                                    'name' => $data['name'],
                                    'contents' => fopen($data['file'], 'r')
                                ]
                            ],
                            'headers' => ['x-access-token' => $this->token],
                        ]);
                    } else {
                        $response = $this->client->post($api_url, [RequestOptions::JSON => $data,
                            'headers' => ['x-access-token' => $this->token],
                        ]);
                    }
                    if ($response->getStatusCode() == 200) {
                        $data = json_decode($response->getBody()->getContents(), true);
                        $result['statusCode'] = $response->getStatusCode();
                        $result['data'] = $data;
                        return $result;
                    } else {
                        return (['status' => 'failed', 'code' => 500, 'message' => 'The Server is temporarily unable to service your request due to maintenance downtime. Please try later']);
                    }
                } catch (Exception $e) {
                    $response->code = 400;
                    $response->message = $e->getMessage();
                    return $response;
                }
                break;
            case "delete":
                $response = null;
                try {
                    $response = $this->client->delete($api_url, [

                        'headers' => ['x-access-token' => $this->token],
                    ]);
                    $responseBody = json_decode($response->getBody()->getContents());
                    return $responseBody;

                } catch (\Exception $e) {
                    $response->code = 400;
                    $response->message = $e->getMessage();
                    return $response;
                }
            case "put":
                $result = [];
                $response = null;
                try {


                    if ($is_multipart) {
                        $response = $this->client->request('POST', $api_url, [
                            'multipart' => [
                                [
                                    'name' => $data['name'],
                                    'contents' => fopen($data['file'], 'r')
                                ]
                            ],
                            'headers' => ['x-access-token' => $this->token],
                        ]);
                    } else {
                        $response = $this->client->put($api_url, [RequestOptions::JSON => $data,
                            'headers' => ['x-access-token' => $this->token],
                        ]);
                    }
                    if ($response->getStatusCode() == 200) {
                        $data = json_decode($response->getBody()->getContents(), true);
                        $result['statusCode'] = $response->getStatusCode();
                        $result['data'] = $data;
                        return $result;
                    }
                } catch (\Exception $e) {
                    $response->code = 400;
                    $response->message = $e->getMessage();
                    return $response;
                }
        }
    }

    public function postApiCall($method, $api_url, $data = null, $is_multipart = false)  //for APIs that are not using Access Token
    {
        switch (strtolower($method)) {
            case "get":
                $result = [];
                try {
                    $response = $this->client->get($api_url);
                    return json_decode($response->getBody()->getContents());
                } catch (Exception $e) {
                    $response->code = 400;
                    $response->message = $e->getMessage();
                    return $response;
                }
                break;
            case "post":
                $result = [];
                $response = null;
                try {
                    if ($is_multipart) {
                        $response = $this->client->request('POST', $api_url, [
                            'multipart' => [
                                [
                                    'name' => $data['name'],
                                    'contents' => fopen($data['file'], 'r')
                                ]
                            ],
                        ]);
                    } else {
                        $response = $this->client->post($api_url, [RequestOptions::JSON => $data]);
                    }
                    if ($response->getStatusCode() == 200) {
                        return json_decode($response->getBody()->getContents(), true);
                    } else {
                        return (['status' => 'failed', 'code' => 500, 'message' => 'The Server is temporarily unable to service your request due to maintenance downtime. Please try later']);
                    }
                } catch (Exception $e) {
                    $response->code = 400;
                    $response->message = $e->getMessage();
                    return $response;
                }
                break;
            case "put":
                $result = [];
                $response = null;
                try {
                    if ($is_multipart) {
                        $response = $this->client->request('put', $api_url, [
                            'multipart' => [
                                [
                                    'name' => $data['name'],
                                    'contents' => fopen($data['file'], 'r')
                                ]
                            ],
                        ]);
                    } else {
                        $response = $this->client->put($api_url, [RequestOptions::JSON => $data]);
                    }
                    if ($response->getStatusCode() == 200) {
                        return json_decode($response->getBody()->getContents(), true);
                    } else {
                        return (['status' => 'failed', 'code' => 500, 'message' => 'The Server is temporarily unable to service your request due to maintenance downtime. Please try later']);
                    }
                } catch (Exception $e) {
                    $response->code = 400;
                    $response->message = $e->getMessage();
                    return $response;
                }
                break;
            case "delete":
                $response = null;
                try {
                    $response = $this->client->delete($api_url);
                    $responseBody = json_decode($response->getBody()->getContents());
                    return $responseBody;

                } catch (\Exception $e) {
                    $response->code = 400;
                    $response->message = $e->getMessage();
                    return $response;
                }
            case "put":
                $result = [];
                $response = null;
                try {
                    if ($is_multipart) {
                        $response = $this->client->request('POST', $api_url, [
                            'multipart' => [
                                [
                                    'name' => $data['name'],
                                    'contents' => fopen($data['file'], 'r')
                                ]
                            ],
                        ]);
                    } else {

                        $response = $this->client->put($api_url, [RequestOptions::JSON => $data
                        ]);

                    }
                    if ($response->getStatusCode() == 200) {
                        $data = json_decode($response->getBody()->getContents(), true);
                        $result['statusCode'] = $response->getStatusCode();
                        $result['data'] = $data;
                        return $result;
                    }
                } catch (\Exception $e) {
                    $response->code = 400;
                    $response->message = $e->getMessage();
                    return $response;
                }
        }
    }

    public function responseHandlerApi($response)
    {
        if ($response['data']['code'] == 200) {
            $result['code'] = 200;
            $result['data'] = $response['data']['data'];
            $result['message'] = $response['data']['message'];
            if (isset($response['data']['totalCount'])) {
                $result['count'] = $response['data']['totalCount'];
            }
        } else if ($response['data']['code'] == 400) {
            $result['code'] = $response['data']['code'];
            $result['data'] = $response['data']['data'];
            $result['message'] = $response['data']['message'];
            $result['error'] = $response['data']['error'];
        } else {
            $result['code'] = $response['data']['code'];
            $result['message'] = $response['data']['code'] === 400 ? $response['data']['message'] : $result['msg'] = $response['data']['code'] == 404 ? $response['data']['error'] : $response['data']['message'];
        }
        return $result;
    }

    public function responseHandler($response)
    {
        if ($response->code == 200) {
            $result['code'] = $response->code;
            if(isset($response->message))
            {
                $result['message'] = $response->message;
            }
            if (isset($response->data))
            {
                $result['data'] = $response->data;
            }
        } else if ($response->code == 400) {
            $result['code'] = $response->code;
            if(isset($response->message))
            {
                $result['message'] = $response->message;
            }
            $result['error'] = $response->error;
            if (isset($response->data))
            {
                $result['data'] = $response->data;
            }
        } else {
            $result['code'] = $response->code;
            if(isset($response->message))
            {
                $result['message'] = $response->message;
            }
            if (isset($response->data))
            {
                $result['data'] = $response->data;
            }
        }
        return $result;
    }

    public function responseHandlerwithArray($response)
    {
        if ($response['code'] == 200) {
            $result['code'] = $response['code'];
            if(isset($response['message']))
            {
                $result['message'] = $response['message'];
            }
            if(isset($response['data']))
            {
                $result['data'] = $response['data'];
            }
        } else if ($response['code'] == 400) {
            $result['code'] = $response['code'];
            if (isset($response['message']))
            {
                $result['message'] = $response['message'];
            }
            if (isset($response['data']))
            {
                $result['data'] = $response['data'];
            }
            if (isset($response['error']))
            {
                $result['error'] = $response['error'];
            }
        } else {
            $result['code'] = $response['code'];
            if (isset($response['message']))
            {
                $result['message'] = $response['message'];
            }
            if (isset($response['data']))
            {
                $result['data'] = $response['data'];
            }
            if (isset($response['error']))
            {
                $result['error'] = $response['error'];
            }
        }
        return $result;
    }

    public function getTeamNewSession()
    {
        $teamid = 0;
        $teamname = "";
        $teamDetails = [];
        $apiUrl =  ApiConfig::get('/team/getDetails');
        $response = $this->postApiCallWithAuth('get', $apiUrl);
        if ($response['code'] === 200) {
            if ($response['data']->code === 200) {
                $teamid = $response['data']->data[0][0]->team_id;
                $teamname = $response['data']->data[0][0]->team_name;
            }
            $teamDetails['teamid'] = $teamid;
            $teamDetails['teamName'] = $teamname;
        }
        return $teamDetails;
    }


    public function errorHandler($exception, $functionName)
    {
        Log::info('Exception ' . $exception->getLine() . " => Function Name => " . $functionName . " => code =>" . $exception->getCode() . " => message =>  " . $exception->getMessage());
        $result['code'] = 500;
        $result['message'] = "Some error occurred while fetching data Please reload it...";
        return $result;
    }

    public function logException($exception, $functionName)
    {
        Log::info('Exception ' . $exception->getLine() . " => Function Name => " . $functionName . " => code =>" . $exception->getCode() . " => message =>  " . $exception->getMessage());
    }


    public function guzzleErrorHandler($guzzleException, $functionName)
    {
        $result['code'] = 403;
        $result['message'] = $guzzleException->getMessage();
        Log::info("GuzzleException => Function Name => " . $functionName . "=> code =>" . $result['code'] . " => message =>  " . $result['message']);
        return $result;
    }

}
