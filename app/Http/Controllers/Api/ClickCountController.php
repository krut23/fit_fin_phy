<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Infrastructure\ApiServiceResponse;
use App\Models\ClickCount;
use Illuminate\Http\Request;
use Validator;

class ClickCountController extends BaseController
{

    // Add Click
    public function addClick(Request $request, $key) {

        $response = new ApiServiceResponse();
        $reqData = $request->all();

        if (!in_array($key, CLICK_KEYS)) return $this->sendFail($this->getValidationMessagesFormat('Invalid Key'));

        $record = new ClickCount;
        $record->phone_book_user_id = _user->id;
        $record->type = $key;
        $record->save();

        return $this->sendSuccess($record, 'Count Saved Successfully');


    }


}
