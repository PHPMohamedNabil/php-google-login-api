<?php

namespace App\Controllers;

use App\Core\Controller;
use Style\Style;
use App\Core\Request;
use App\Traits\GoogleConfigrationTrait;
use Google\Client as Google;
use App\Core\Url;

class GoogleController extends Controller
{  
	 use GoogleConfigrationTrait;

	public function __construct(private $client_id,private $client_secret,private $client,private $redirect_url)
	{      
	    $this->googleClient(new Google);
	}

	public function index(Request $request)
	{    	   
	     if($request->code)
	      { 
		   $token = $this->getAccessToken($request->code);
		 
		      if(isset($token['error']))
		      {
			  return Url::redirectwith(route_name('google_login'),['error'=>'Connection faild:login faild please try to login again afer 1 minutes']);
		      }
			 session()->set('token',$token);
			
			return Url::redirect(route_name('home_page'));
	
	       }

		  return view('google_login',['login_url'=>$this->getLoginUrl()]);    
        }

	public function home(Request $request)
	{       
		$user_info  = $this->getUserData($this->client);   
	
		return view('home_page',compact('user_info'));

	}
	
     //if you are saving user profile data to db
	public function profile(Request $request)
	{       
		$user_info  = $this->saveOrGetUserData($this->client);   
	
		return view('home_profile',compact('user_info'));

	}

	public function logout()
	{
		$this->revokeUserToken();
	
		session()->invalidate();
	
		return Url::redirect(route_name('google_login'));

	}

	
}