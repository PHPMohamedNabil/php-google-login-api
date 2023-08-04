<?php

namespace App\Core;

use OutOfRangeException;

class Response{


    private $headers=[];

    private $response =[];

    private $status_codes = [
        // INFORMATIONAL CODES
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        // SUCCESS CODES
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-status',
        208 => 'Already Reported',
        // REDIRECTION CODES
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy', // Deprecated
        307 => 'Temporary Redirect',
        // CLIENT ERROR
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested range not satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        419 =>'session has expired while processing a post request',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        498=>' client submits a HTTP request that does not include a valid token',
        // SERVER ERROR
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out',
        505 => 'HTTP Version not supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        511 => 'Network Authentication Required',
    ];

    
    public function __construct()
    {

    }

    public function httpResponse(int $code)
    {   
        if(!in_array($code,array_keys($this->status_codes)))
         {
             throw new OutOfRangeException('Undefined or unsupported response code');
         }
         
        return http_response_code($code);

    }

    public function sendHeader($header,$all=false)
    {
        if($all)
        {
            if(count($this->headers)>0)
            {
                foreach($this->headers as $header)
                {
                  
                        header($header);
                    
                }
                return $this;
            }
        }
            header($header);
         return $this;
    }

    public function setHeaders($headers)
    {
          $this->headers[]=$headers;
    }

    public function getHeaders()
    {  
        return $this->headers;
    }
    

    public static function json($data)
    {   
         $this->sendHeader('Access-Control-Allow-Orgin: *');
         $this->sendHeader('Access-Control-Allow-Methods: *');
         $this->sendHeader('Content-Type: application/json');

         return json_encode($data);
    }

}