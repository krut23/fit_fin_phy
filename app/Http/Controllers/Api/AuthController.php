<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use Validator, Hash;
use Illuminate\Http\Request;
use App\Models\PhoneBookUser;
use App\Http\Controllers\BaseController;
use App\Infrastructure\ApiServiceResponse;
class AuthController extends BaseController
{

// Login
public function login(Request $request)
{

    $response = new ApiServiceResponse();
    $reqData = $request->all();

    // check validation [
    $validator = Validator::make($reqData, [
        'email' => 'required',
    ]);

    if ($validator->fails()) return $this->sendFail($this->getValidationMessagesFormat($validator->messages()));
    // ] Check validation


    $record = PhoneBookUser::where(['email' => $reqData['email']])->first();
     // dd($record);
    if (empty($record))
    {
         $record = new PhoneBookUser;
         $record->name = getValue($reqData, 'name');
         $record->email = getValue($reqData, 'email');
         $record->phone = getValue($reqData, 'phone');
         $record->profile_url = getValue($reqData, 'profile_url');
         $record->social_id = getValue($reqData, 'social_id');
    }

    $apiToken = $response->getNewApiToken($record->id);
    $record->api_token = $apiToken;
    $record->fcm_token = getValue($reqData, 'fcm_token');

     // Update user login after last_login_at and expires_at current date and expires_at after 30 days on last_login_at
     $record->last_login_at = Carbon::now();
     $record->expires_at = Carbon::now()->addDays(30);
     $record->is_active = 1;

     $record->save();

        $record = PhoneBookUser::where(['email' => $reqData['email']])->first()->toArray();
     $record['api_token'] = $apiToken;

     return $this->sendSuccess($record, 'Login Successfully');
}


public function update_date(Request $request)
{
    // Get the user's API token
    $apiToken = $request->bearerToken();

    // Find the user with the given API token
    $user = PhoneBookUser::where('api_token', $apiToken)->first();

    if (!$user) {
        return abort(404);
    }

    // Update the last_login_at and expires_at fields
    $user->last_login_at = Carbon::now();
    $user->expires_at = Carbon::now()->addDays(30);
    $user->is_active = 1;
    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'Login information updated successfully.',
    ]);
}


public function expiredDate()
{
    $expires_at = now()->subDays(30);
    PhoneBookUser::where('last_login_at','<=',$expires_at)->update(['is_active'=>0]);
    return redirect()->back();
}
 // Logout
public function logout(Request $request)
{

        $response = new ApiServiceResponse();
        $reqData = $request->all();

        //        $user = User::find(_user->id);
        //        $user->api_token = null;
        //        $user->save();

        return $this->sendSuccess(null, 'Logout Successfully');


}


}
