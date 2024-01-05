<?php

namespace App\Http\Controllers;

use App\Infrastructure\ApiServiceResponse;
use DateTime;
use Illuminate\Http\Request;
use Response;

class BaseController extends Controller
{

    public function __construct(Request $request) {
        // if (API_DEBUG == true && $request->is('api/' . API_VERSION . '/*')) {
        //     $req_dump = print_r(json_encode($request->all()), TRUE);
        //     $req_dump .= sprintf(url()->current());
        //     $fp = fopen('newfile.txt', 'a');
        //     fwrite($fp, "\n" . \Carbon\Carbon::now());
        //     fwrite($fp, "\n" . $req_dump);
        //     fwrite($fp, "\n");
        //     fclose($fp);
        // }
    }


    // Generate api token
    public function generateApiToken($value) {
        return md5($value);
        // return md5(time() . str_random(30)) . md5($value) . md5(str_random(30) . time());
    }


    // Get json response
    public function GetJsonResponse($serviceResponse, $code = 200) {
        $jsonResponse = Response::make(json_encode($serviceResponse, JSON_NUMERIC_CHECK), $code);
        $jsonResponse->header('Content-Type', 'application/json');
        return $jsonResponse;
    }

    public function sendSuccess($resData, $message='Success') {
        $response = new ApiServiceResponse();
        return $response->sendSuccess($resData, $message);
    }
    public function sendFail($message='Success', $resData = null) {
        $response = new ApiServiceResponse();
        return $response->sendFail($message,$resData);
    }

    // Get validation message formate
    public static function getValidationMessagesFormat($validationMessage) {
        $validationMessagesArray = "";
        if (!empty($validationMessage)) {
            foreach ($validationMessage->toArray() as $key => $value) {
                $validationMessagesArray .= $value[0];
            }
        }
        return $validationMessagesArray;
    }


    // Generate random number
    public function generateRandomNumber($length = 6) {
        $number = '1234567890';
        $numberLength = strlen($number);
        $randomNumber = '';
        for ($i = 0; $i < $length; $i++) {
            $randomNumber .= $number[rand(0, $numberLength - 1)];
        }
        return $randomNumber;
    }


    // Date time to user time eclapse
    public function userTimeEclapse($createdDate, $timezone = 'UTC') {
        $currentTime = \Carbon\Carbon::now()->setTimezone($timezone);
        //$createdDate = date('d/m/Y', strtotime($createdDate));
        new DateTime(date("Y-m-d H:i:s"));

        $difference = $currentTime->diff($createdDate);

        $timeStr = '';

        if ($difference->y > 0) {
            $timeStr = $difference->y . ' years ago';
            return ($timeStr);
        }
        if ($difference->m > 0) {
            $timeStr = $difference->m . ' months ago';
            return ($timeStr);
        }
        if ($difference->d > 0) {
            $timeStr = $difference->d . ' days ago';
            return ($timeStr);
        }
        if ($difference->h > 0) {
            $timeStr = $difference->h . ' hrs ago';
            return ($timeStr);
        }
        if ($difference->i > 0) {
            $timeStr = $difference->i . ' mins ago';
            return ($timeStr);
        }
        $timeStr = $difference->s . ' sec ago';
        return ($timeStr);
    }
}
