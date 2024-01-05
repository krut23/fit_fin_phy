<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Infrastructure\ServiceResponse;
use App\Models\Config;
use Illuminate\Http\Request;
use Psy\Util\Json;
use Validator;


class PaidFeaturesController extends BaseController
{
    public $pageTitle = ['s' => 'Paid Features', 'p' => 'Paid Features'];

    /**
     * Display a view
     * Method GET
     */
    public function index() {

        $configs = Config::where('key', 'paid-features')->first();

        if (empty($configs)) {
            $configs = new Config;
            $configs->key = 'paid-features';
            $configs->data = json_encode([
                'expense' => false,
                'income' => false,
                'bank' => false,
                'goal' => false,
                'budget' => false,
                'reports' => false,
                'water-remainder' => false,
                'sleep-remainder' => false,
                'medicine-reminder' => false,
                'heart-rate-monitor' => false,
                'task-manager' => false,
                'habit-manager' => false,
                'step-counter' => false,
                'calorie-and-distance' => false,
                'guest-mode' => false,
            ]);
            $configs->save();
        }
        $configs = $configs->toArray();
        $configs['data'] = json_decode($configs['data']);
//        $configs['data']['id'] = $configs['id'];

        $viewData = [
            'pageTitle' => $this->pageTitle,
            'routes' => [
//                'show' => route('clicks.show'),
                'store' => route('paid.features.store'),
//                'destroy' => route('school.destroy'),
//                'update' => route('school.update'),
            ],
            'breadcrumbs' => [ /*['label' => 'Dashboard', 'route' => route('dashboard')]*/],
            'record' => $configs,
        ];

        return view('admin.common-config', [
            'title' => $this->pageTitle['p'],
            'jsController' => 'paidFeaturesCtrl',
            'viewData' => json_encode($viewData),
        ]);
    }


    /**
     * Save or Update record
     * Method POST
     */
    public function store(Request $request) {
        $reqData = $request->all();
        $response = new ServiceResponse();
        $id = !empty($reqData['id']) ? $reqData['id'] : 0;

        // Check validation [
//        $validation = [
//            'name' => 'required | max: 255',
////            'language_id' => 'required | max: 255',
////            'attachment' => 'required | max: 255',
//        ];
//
//        $validator = Validator::make($reqData, $validation);

        // ] Check validation

        $record = Config::find($reqData['id']);
        
        $record->data = json_encode([
                'expense' => getValue($reqData, 'expense', 't'),
                'income' => getValue($reqData, 'income', 't'),
                'bank' => getValue($reqData, 'bank', 't'),
                'goal' => getValue($reqData, 'goal', 't'),
                'budget' => getValue($reqData, 'budget', 't'),
                'reports' => getValue($reqData, 'reports', 't'),
                'water-remainder' => getValue($reqData, 'water-remainder', 't'),
                'sleep-remainder' => getValue($reqData, 'sleep-remainder', 't'),
                'medicine-reminder' => getValue($reqData, 'medicine-reminder', 't'),
                'heart-rate-monitor' => getValue($reqData, 'heart-rate-monitor', 't'),
                'task-manager' => getValue($reqData, 'task-manager', 't'),
                'habit-manager' => getValue($reqData, 'habit-manager', 't'),
                'step-counter' => getValue($reqData, 'step-counter', 't'),
                'calorie-and-distance' => getValue($reqData, 'calorie-and-distance', 't'),
                'guest-mode' => getValue($reqData, 'guest-mode', 't'),
            ]);
        $record->save();

        $response->IsSuccess = true;
        $response->Message = $id > 0 ? $this->pageTitle['s'] . ' updated successfully.' : $this->pageTitle['s'] . ' added successfully.';
        return $this->GetJsonResponse($response);
    }

}
