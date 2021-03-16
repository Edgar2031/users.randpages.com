<?php


namespace App\ApiConfig;


class ApiConfig
{

    private function API_URL()
    {
        return env('API_URL');
    }

    private function API_VERSION()
    {
        return env('API_VERSION');
    }

    private function api($address)
    {
        return $address != null ? $this->API_URL().$this->API_VERSION() . $address : $this->API_URL().$this->API_VERSION();
    }
    public static function get($address = null)
    {
        $apicongig =  new ApiConfig();
        return $apicongig->api($address);
    }

}
