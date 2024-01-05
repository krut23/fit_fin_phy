<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Infrastructure\Media;
use App\Infrastructure\ServiceResponse;
use App\Models\ClickCount;
use Illuminate\Http\Request;
use Validator, DB;


class ClickCountsController extends BaseController
{
    public $pageTitle = ['s' => 'Click', 'p' => 'Clicks'];

    /**
     * Display a view
     * Method GET
     */
    public function index($key, $userId = null) {

        $viewData = [
            'pageTitle' => $this->pageTitle,
            'routes' => [
                'show' => route('clicks.show'),
//                'store' => route('school.store'),
//                'destroy' => route('school.destroy'),
//                'update' => route('school.update'),
            ],
            'breadcrumbs' => [ /*['label' => 'Dashboard', 'route' => route('dashboard')]*/],
            'clickKey' => $key,
            'userId' => $userId,
        ];

        return view('admin.common-chart', [
            'title' => $this->pageTitle['p'],
            'jsController' => 'clickCtrl',
            'viewData' => json_encode($viewData),
        ]);
    }

    /**
     * Get data list.
     * Method POST
     */
    public function show(Request $request) {
        $response = new ServiceResponse();
        $reqData = $request->all();

        $query = ClickCount::select(DB::raw('count(*) as total'), DB::raw("DATE_FORMAT(created_at, '%d %b %Y') as date"))->where('type', $reqData['clickKey']);
        if (!empty($reqData['userId'])) {

            $query = $query->where('phone_book_user_id', $reqData['userId']);
        }

        if (!empty($reqData['fromDate'])) {
            $from_date = date('Y-m-d H:i:s', strtotime($reqData['fromDate']));
            $query = $query->whereDate('created_at', '>=', $from_date);
        }
        if (!empty($reqData['toDate'])) {
            $to_date = date('Y-m-d H:i:s', strtotime($reqData['toDate'] . ' +0 day'));
            $query = $query->whereDate('created_at', '<=', $to_date);
        }

        $records = $query->groupBy('date')->
        orderBy('date')->
        get()->
        toArray();


        if (empty($records)) $records = [];

        $resData = [
            'labels' => array_column($records, 'date'),
            'data' => array_column($records, 'total'),
        ];

        $response->Data = $resData;
        $response->IsSuccess = true;
        return $this->GetJsonResponse($response);
    }


}
