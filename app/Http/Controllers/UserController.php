<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Users_site;
use App\Order;



class UserController extends Controller
{
	// <= ======================== Sign up page ======================== =>
    public function sign_up()
    {
    	return view('users.sign_up');
    }
 	


 	// <= ======================== Register checking =================== =>
	public function register(Request $request)
    {
    	// dump($request);
    	$validator = Validator::make(
		   $request->all(),
		    array(
		        'surname' => 'required|alpha_dash|string|min:3|max:12',
		        'name'    => 'required|alpha_dash|string|min:3|max:12',
		        'email'   => 'required|email',
		        'tel'     => 'required|integer'
		    )
		    // ,
		    // array(
		    // 	'name.required' => 'datark',
		    // 	'email' => 'address error'
		    // )
		);

 		$user = Users_site::where('email', $request->email)->first();
		$validator->after(function($validator) use($user){
			if ($user) 
			{
				$validator->errors()->add('email', 'urish mail');		
			}
		});

		if ($validator->fails()) 
		{
			// Переданные данные не прошли проверку
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else 
		{
			$gen_password   = Str::random(10);
			$user           = new Users_site();
			$user->name     = $request->input('name');
			$user->surname  = $request->input('surname');
			$user->email    = $request->input('email');
			$user->password = Hash::make($gen_password);
			$user->tel      = $request->tel;
			$user->save();

			$send = array('name' => $user->name, 'surname' => $user->surname, 'email' => $user->email, 'password' => $gen_password);
			Mail::send('mails.send_password', $send, function($message) use($user, $gen_password){
				$message->from(env('MAIL_USERNAME'), 'Password');
				$message->to($user->email, "$user->name $gen_password $user->surname")
						->subject('Password');
			});
			return Redirect::to('/sign_in');
		}
    }



    // <= ======================== Sign in page ======================== =>
    public function sign_in()
    {
    	return view('users.sign_in');
    }
    


    // <= ======================== Login checking ====================== =>
    public function log_in(Request $request)
    {
    	$validator = Validator::make(
		   	$request->all(),
		    array(
		        'email' => 'required',
		        'password' => 'required|min:6|max:255',
		    )
		);
			
		$user = Users_site::where('email', $request->input('email'))->first();
		$validator->after(function($validator) use($user, $request){
			if (!$user) {
				$validator->errors()->add('email', 'chka tenc mail');		
			}
			else if (!Hash::check($request->input('password'), $user['password'])){
				$validator->errors()->add('password', 'sxal password');		
			}
		});

		if ($validator->fails())
		{
			// Переданные данные не прошли проверку
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else 
		{		
			Session::put('id', $user->id);
			return Redirect::to('/personal_area');
		}
    }



    // <= ======================== Personal area page ============== =>
	public function personal_area()
	{
		$user = Users_site::where('id', Session::get('id'))->select('name', 'surname', 'email', 'tel')->first();
		return view('users.personal_area', compact('user'));
	}


    // <= ======================== Personal history page ============== =>
	public function personal_history()
	{
		$order = Order::where('id', Session::get('id'))->get();
		return view('users.personal_history', compact('order'));
	}



	// <= ======================== User edit ======================== =>
	public function user_edit(Request $request)
	{
		$validator = Validator::make(
		   $request->all(),
		    array(
		        'name'    => 'required|alpha_dash|string|min:3|max:12',
		        'surname' => 'required|alpha_dash|string|min:3|max:12',
		        'email'   => 'required|email',
		        'tel'     => 'required|integer'
		    )
		    // ,
		    // array(
		    // 	'name.required' => 'datark',
		    // 	'email' => 'address error'
		    // )
		);

 		$data = Users_site::where('id', Session::get('id'))->first('email');
    	$user = Users_site::where('email', $request->input('email'))->where('email', '!=', $data->email)->first();
		$validator->after(function($validator) use($user){
			if ($user) 
			{
				$validator->errors()->add('email', 'urish mail');		
			}
		});

		if ($validator->fails()) 
		{
			// Переданные данные не прошли проверку
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else 
		{
			Users_site::where('id', Session::get('id'))
						->update(array(
								'name'    => $request->input('name'), 
								'surname' => $request->input('surname'), 
								'email'   => $request->input('email'), 
								'tel'     => $request->input('tel')
							));
			return Redirect::back();
		}
	}



    // <= ======================== Logout ======================== =>
	public function g_logout()
	{
		Session::flush('id');
        return Redirect::to('/sign_in');
	}



	// <= ======================== Repeat password page ========== =>
	public function personal_password()
	{
		return view('users.personal_password');
	}



	// <= ======================== Repeat password ========== =>
	public function repeat_password(Request $request)
	{
		$validator = Validator::make(
		    $request->all(),
		    array(
		        'old_password'    => 'required|min:6|max:255',
		        'new_password'    => 'required|min:6|max:255',
		        'repeat_password' => 'required|same:new_password',
		    )
		    // ,
		    // array(
		    // 	'name.required' => 'datark',
		    // 	'email' => 'address error'
		    // )
		);


		$user = Users_site::where('id', Session::get('id'))->first('password');
		$validator->after(function($validator) use($user, $request){
			if (!Hash::check($request->input('old_password'), $user['password']))
			{
				$validator->errors()->add('old_password', 'sxal password');		
			}
		});

		if ($validator->fails()) 
		{
			// Переданные данные не прошли проверку
			return Redirect::back()->withInput()->withErrors($validator);
		}
		else 
		{
			Users_site::where('id', Session::get('id'))
						->update(array('password' => Hash::make($request->input('new_password'))));
			return Redirect::back();
		}
	}



}
