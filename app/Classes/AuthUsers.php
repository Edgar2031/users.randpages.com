<?php

namespace App\Classes;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Object_;

class AuthUsers
{
    public static function has() {
        if (session()->has('user'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public static function id() {
        if (session()->has('user'))
        {
            return session()->get('user')['userDetails']['user_id'];
        }
       return null;
    }

    public static function user() {
        if (session()->has('user'))
        {
            return (object)session()->get('user')['userDetails'];
        }
        return null;
    }

    public static function __token() {
        if (session()->has('user'))
        {
            return session()->get('user')['accessToken'];
        }
        return null;
    }

    public static function login($user) {
        session()->put('user', $user);
        return true;
    }

    public static function logout() {
        Session::flush();
        return true;
    }
    public static function  this()
    {
        $result = new AuthUsers();
        return $result;
    }
}
