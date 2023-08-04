<?php

namespace App\Traits;

use Google_Service_Oauth2;
use App\Core\Database\NativeDB;

trait GoogleConfigrationTrait{

    protected Const REDIRECT_URL = SITE_URL.'google/login';

	public function googleClient($client)
	{
		    $this->client        = $client;
			$this->client_id     = env('Google_Client_ID');
			$this->client_secret = env('Google_Client_Secret');

			$this->setCreditionals();
	}

    public function setCreditionals()
	{
		 $this->client->setClientId($this->client_id);
		 $this->client->setClientSecret($this->client_secret);
		 $this->client->setRedirectUri(self::REDIRECT_URL);
		 $this->scops(['email','profile']);

	}

	public function scops(array $scops):void
	{
		
        foreach ($scops as $scop)
        {
        	$this->client->addScope($scop);
            
        }
        return;
	}

	public function getUserData($client)
	{
		$client->setAccessToken(session()->get('token'));
		
		$google_oauth = new Google_Service_Oauth2($client);
        $user_info    = $google_oauth->userinfo->get();

        return $user_info;
	}

    public function getLoginUrl()
	{
		return $this->client->createAuthUrl();
	}

	public function getAccessToken($code)
	{
		return $this->client->fetchAccessTokenWithAuthCode($code);
	}

	public function revokeUserToken()
	{
		$client = $this->client;
		$client->setAccessToken(session()->get('token'));
		# Revoking the google access token
		return $client->revokeToken();
	}

   //for database insert operation
	public function saveOrGetUserData($client)
	{ 
		$user_info = $this->getUserData($client);

		$oauth_uid   = $user_info['id'];
	    $f_name    = $user_info['givenName'];
	    $l_name    = $user_info['familyName'] ??'';
	    $email     = $user_info['email'];
	    $gender    = $user_info['gender'];
	    $local     = $user_info['local'];
	    $picture   = $user_info['picture'];

	    if(!$this->isEmailExists($email) || $this->isEmailExists($email) == null)
	    {
	    	NativeDB::getInstance()->table('google_users')->insertInto([
          	'oauth_uid'     =>$oauth_uid,
          	'first_name'    =>$f_name,
          	'last_name'     =>$l_name,
          	'email'         =>$email,
          	'gender'        =>$gender,
          	'local'         =>$local,
          	'profile_pic'   =>$picture
          ]);
            
            return $this->getUserByEmail($email);
	    }
	    else
	    {
            return $this->getUserByEmail($email);
	    }

	}
   
   //check if email exists in db
	public function isEmailExists($email)
	{
      return NativeDB::getInstance()->table('google_users')->select('email')->where('email','=',$email)->run();
	}

	public function getUserByEmail($email)
	{
		return NativeDB::getInstance()->table('google_users')->select('*')->where('email','=',$email)->run();
	}

}