<?php

namespace App\Middlewares;
use Optimus\Onion\LayerInterface;
use App\Core\Request;
use App\Core\Response;
use App\Core\Url;
use Closure;
use RuntimeException;

class GoogleAuthCheck implements LayerInterface
{   
    

    public function peel($request,Closure $next)
    {     
         if(!session()->has('token'))
         {
             Url::redirect(route_name('google_login'));
         }
                  
           return $next($request);
    
    }

    

}