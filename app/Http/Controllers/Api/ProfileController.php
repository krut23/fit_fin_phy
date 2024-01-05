<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Infrastructure\ApiServiceResponse;
use App\Infrastructure\Media;
use App\Models\PhoneBookUser;
use App\Models\Config;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class ProfileController extends BaseController
{


    // Details
     // Details
    public function details(Request $request) {

        $response = new ApiServiceResponse();
        $reqData = $request->all();
//        dd(_user->id);
        $record = PhoneBookUser::find(_user->id)->toArray();

        $configs = Config::where('key', 'plan')->first();
        if (empty($configs)) return $this->sendFail();
        $configs = $configs->toArray();
//        dd($record);
        $record['backup_file'] = Media::get($record['backup_file']);
        $record['is_plan_active'] = !empty(PhoneBookUser::where('id', $record['id'])->where('plan_expire_at', '>=', Carbon::today())->orderByDesc('id')->first());
        $record['plan_purchase_days'] = $configs['data'];

        return $this->sendSuccess($record, 'Details Found');

    }


    public function planPurchase(Request $request) {

        $reqData = $request->all();

        // check validation [
        $validator = Validator::make($reqData, [
            'plan_days' => 'required',
        ]);
        if ($validator->fails()) return $this->sendFail($this->getValidationMessagesFormat($validator->messages()));
        // ] Check validation

        $record = PhoneBookUser::find(_user->id);

        $record->plan_expire_at = Carbon::now()->addDays($reqData['plan_days']);
        $record->save();

        return $this->sendSuccess(null, 'Plan Activated');

    }


    public function backup(Request $request) {

        $reqData = $request->all();

        // check validation [
        $validator = Validator::make($reqData, [
            'backup_file' => 'required',
        ]);
        if ($validator->fails()) return $this->sendFail($this->getValidationMessagesFormat($validator->messages()));
        // ] Check validation

        $record = PhoneBookUser::find(_user->id);

        $record->backup_file = $this->setMedia($reqData, 'backup_file', $record->backup_file, '');

        $record->save();

        return $this->sendSuccess(null, 'Backup Saved');

    }


}
