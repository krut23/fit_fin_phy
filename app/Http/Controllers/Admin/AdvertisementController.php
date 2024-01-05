<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Infrastructure\ServiceResponse;
use App\Models\Config;
use Illuminate\Http\Request;
use Validator;


class AdvertisementController extends BaseController
{
    public $pageTitle = ['s' => 'Advertisements', 'p' => 'Advertisements'];

    /**
     * Display a view
     * Method GET
     */
    public function index() {

        $configs = Config::where('key', 'advertisement')->first();

        if (empty($configs)) {
            $configs = new Config;
            $configs->key = 'advertisement';
            $configs->data = '';
            $configs->save();
        }
        $configs = $configs->toArray();
        $configs['data'] = json_decode($configs['data']);
//        $configs['data']['id'] = $configs['id'];

        $viewData = [
            'pageTitle' => $this->pageTitle,
            'routes' => [
//                'show' => route('clicks.show'),
                'store' => route('advertisements.store'),
//                'destroy' => route('school.destroy'),
//                'update' => route('school.update'),
            ],
            'breadcrumbs' => [ /*['label' => 'Dashboard', 'route' => route('dashboard')]*/],
            'record' => $configs,
        ];

        return view('admin.common-config', [
            'title' => $this->pageTitle['p'],
            'jsController' => 'advertisementCtrl',
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


        $record = Config::find($reqData['id']);

        $record->data = $reqData['data'];
        $record->save();

        $response->IsSuccess = true;
        $response->Message = $id > 0 ? $this->pageTitle['s'] . ' updated successfully.' : $this->pageTitle['s'] . ' added successfully.';
        return $this->GetJsonResponse($response);
    }

}
