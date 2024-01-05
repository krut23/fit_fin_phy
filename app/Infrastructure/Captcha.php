<?php

namespace App\Infrastructure;

class Captcha
{
    // /encryption & decryption
    public static $splitKey = 'IsW2UsI';

   // encryption & decryption
    public static function convert_special($value) {
        $new = str_replace(['+','/','='],['P10s','D4sH','3q84L'],$value);

        return $new;
    }


    public static function deconvert_special($value) {
        $new = str_replace(['P10s','D4sH','3q84L'],['+','/','='],$value);

        return $new;
    }

    public static function encrypt($data, $key="fdhfdhgdhdfgh", $iv='1234567891011121'){

        // Store the cipher method
        $ciphering = "AES-128-CTR";

        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt($data, $ciphering, $key, $options, $iv);

        return self::convert_special($encryption);
    }

    public static function decrypt($data, $key="fdhfdhgdhdfgh", $iv='1234567891011121'){

        $data = self::deconvert_special($data);
        // Store the cipher method
        $ciphering = "AES-128-CTR";

        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Use openssl_decrypt() function to decrypt the data
        $decryption=openssl_decrypt ($data, $ciphering, $key, $options, $iv);

        return $decryption;
    }

    // use for generate iv (its one time use)
    public static function generateIv(){
        $wasItSecure = false;
        $iv = openssl_random_pseudo_bytes(16, $wasItSecure);
        if ($wasItSecure) {
            return array("iv"=>$iv, "isSecure"=>$wasItSecure);
        } else {
            return array("iv"=>$iv, "isSecure"=>$wasItSecure);
        }

    }


    // Check captcha value is valid or not
    public static function captchaIsValid($captcha) {

//        global $splitKey;
        $splitKeyWithEncrypt = self::decrypt($captcha['key']);
        $randomDecryptArr = explode(self::$splitKey,$splitKeyWithEncrypt);
        $randomDecryptValue = $randomDecryptArr[1];
        $randomDecryptKey = $randomDecryptArr[0].self::$splitKey;
        $captchaAnswer = self::decrypt($randomDecryptValue,$randomDecryptKey);

        $isValid = (int)($captchaAnswer === $captcha['answer']);
        return $isValid;
    }

}
