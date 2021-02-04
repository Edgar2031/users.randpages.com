<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Users_site;

class Checking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param string $is
     * @return mixed
     */

    public function handle($request, Closure $next, $is)
    {
        $respone = $next($request);
        switch ($is) 
        {
            case 'login':
                    if (Session::has('id')) 
                    {
                        return Redirect::to('/');
                    }
                    else 
                    {    
                        return $respone->header('Cache-Control','no-cache, no-store, max-age-0, must-revalisate');
                    }
                break;
            case 'users':
                    if (!Session::has('id')) 
                    {
                        return Redirect::to('/sign_in')->with('mess','pliz login');
                    }
                    else 
                    {    
                        return $respone->header('Cache-Control','no-cache, no-store, max-age-0, must-revalisate');
                    }
                break;
        }
    }
}
