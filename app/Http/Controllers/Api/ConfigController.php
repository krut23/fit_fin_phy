<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Infrastructure\ApiServiceResponse;
use App\Models\Config;
use Illuminate\Http\Request;
use Validator;

class ConfigController extends BaseController
{

    // Add Click
    public function moduleType(Request $request) {

        $response = new ApiServiceResponse();
        $reqData = $request->all();
        $configs = Config::where('key', 'paid-features')->first();
        if(empty($configs) || empty($configs->data)) return $this->sendFail('Config Not Found');

        $resData = json_decode( $configs->data);
        return $this->sendSuccess($resData, 'Config Found Successfully');


    }

    public function advertisements(Request $request) {

        $response = new ApiServiceResponse();
        $reqData = $request->all();
        $configs = Config::where('key', 'advertisement')->first();
        if(empty($configs) || empty($configs->data)) return $this->sendFail('Config Not Found');

        $resData = $configs->data;
        return $this->sendSuccess($resData, 'Config Found Successfully');


    }


}
