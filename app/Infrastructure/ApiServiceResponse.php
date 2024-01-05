<?php
namespace App\Infrastructure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Response;

class ApiServiceResponse {
	public $IsSuccess;

	public function __construct($IsRefreshApiToken = 0, $Data = null, $IsSuccess = false, $Message = ''){

//	    $ApiToken = null;
//        if(!empty(Auth::guard('api')->user())){
//            $ApiToken = Auth::guard('api')->user()->api_token;
//        }

//	    if ($IsRefreshApiToken) {
//            $tokenId = !empty($user->id) ? $user->id : '';
//	        $user->api_token = $this->getNewApiToken($tokenId);
//	        $user->save();
//	        $ApiToken = $user->api_token;
//        }

		$this->IsSuccess = $IsSuccess;
		$this->Data = $Data;
		$this->Message = $Message;
//		$this->ApiToken = $ApiToken;
	}

    public function sendSuccess($data, $message='Success') {
        $jsonResponse = Response::make(json_encode([
            'isSuccess' => true,
            'data' => $data,
            'message' => $message,
        ], JSON_NUMERIC_CHECK), 200);
        $jsonResponse->header('Content-Type', 'application/json');
        return $jsonResponse;
    }

    public function sendFail($message='Invalid operation',$data =[]) {
        $jsonResponse = Response::make(json_encode([
            'isSuccess' => false,
            'data' => $data,
            'message' => $message,
        ], JSON_NUMERIC_CHECK), 200);
        $jsonResponse->header('Content-Type', 'application/json');
        return $jsonResponse;
    }

	public function getNewApiToken($tokenId = '') {
//	    return 'thisIsMyDefaultStaticToken';

	    $ApiToken = null;
        $microTime = preg_replace('/[^a-zA-Z0-9\']/', '', microtime());
        $ApiToken = $tokenId .
            $this->getRandomString() .
            time() .
            $this->getRandomString(4) .
            md5($tokenId) .
            md5(mt_rand(1000000000, 9999999999) . time()) .
            $this->getRandomString(14) .
            $microTime .
            md5($this->getRandomString(30))
        ;

	   return $ApiToken;
    }

	public function getRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
