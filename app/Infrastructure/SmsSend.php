<?php

namespace App\Infrastructure;

use Illuminate\Support\Facades\Mail;

//use Image;

class SmsSend
{

    public static function sendOtpSms($phone, $otp){


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://88.99.240.160/http-api.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => ['username' => 'vikasj',
                'password' => 'Ra12345@',
                'senderid' => 'MIDAFA',
                'route' => '1',
                'number' => $phone,
                'message' => 'Your Northcredit Verification code is '.$otp.' Please do not share it with anybody. Thanks Milan'
            ],
            CURLOPT_HTTPHEADER => [
                'Cookie: PHPSESSID=dtkrdf2dpv21lfcg4fn7nssg80'
            ],
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
        return true;

    }

}
