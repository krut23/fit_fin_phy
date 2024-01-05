<?php

namespace App\Infrastructure;

use Illuminate\Support\Facades\Storage;

//use Image;

class AppConstant
{
    public static $secret_ = 'wAPKjsk8cFbvA81EffYz';
    public static $secret_key = 'jPG15eExf6DW7nygqKARnJIOVO5Dr6Q2776KTc2YEJviYBRofg7K5R1anBIMKXvM';

    public static $twilioSid = 'ACc913b10dc2e55fa8f0de67e8f0f743fa';
    public static $twilioToken = 'e8a37fbada22cf401a0dc9b67f509706';
    public static $twilioFrom = '+13344636869';

    public static $referralCoins = 50;

    public static $tenureDays = 31;
    public static $penaltyAmount = 45;
    public static $interestRateDivider = 1000;

    public static $gender = [
        ['id' => 1, 'name' => 'Male'],
        ['id' => 2, 'name' => 'Female'],
    ];

    public static $employeeType = [
        ['id' => 1, 'name' => 'Salaried'],
        ['id' => 2, 'name' => 'Self Employed'],
    ];

    public static $maritalStatus = [
        ['id' => 1, 'name' => 'Single'],
        ['id' => 2, 'name' => 'Married'],
        ['id' => 3, 'name' => 'Divorced'],
    ];

    public static $contactReference = [
        ['id' => 1, 'name' => 'Father'],
        ['id' => 2, 'name' => 'Mother'],
        ['id' => 3, 'name' => 'Spouse'],
    ];

}
