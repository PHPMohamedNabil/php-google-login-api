<?php

namespace App\Middlewares;
use Optimus\Onion\LayerInterface;
use App\Core\Request;
use App\Core\Response;
use App\Core\Url;
use Closure;
use RuntimeException;

class IsLogin implements LayerInterface
{   
    

    public function peel($request,Closure $next)
    {     
         if(session()->has('token'))
         {
             Url::redirect(route_name('home_page'));

          /*if you are storing user data in db redirect to user profile*/
             //Url::redirect(route_name('profile'));

         }

           return $next($request);
    
    }

    

}