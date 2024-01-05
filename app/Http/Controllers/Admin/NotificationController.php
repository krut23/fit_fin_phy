<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Infrastructure\Media;
use App\Infrastructure\ServiceResponse;
use App\Models\Config;
use App\Models\PhoneBookUser;
use Illuminate\Http\Request;
use Psy\Util\Json;
use Validator;


class NotificationController extends BaseController
{
    public $pageTitle = ['s' => 'Notification', 'p' => 'Notifications'];

    /**
     * Display a view
     * Method GET
     */
    public function index() {



        $viewData = [
            'pageTitle' => $this->pageTitle,
            'routes' => [
                'storeImage' => route('notifications.store.image'),
            ],
            'breadcrumbs' => [ /*['label' => 'Dashboard', 'route' => route('dashboard')]*/],
            'customers' => PhoneBookUser::all()->toArray(),
            'cloudMessagingKey' => env('CLOUD_MESSAGING_KEY'),
        ];
        return view('admin.common-notification', [
            'title' => $this->pageTitle['p'],
            'jsController' => 'notificationCtrl',
            'viewData' => json_encode($viewData),
        ]);
    }


    /**
     * Save or Update record
     * Method POST
     */
    public function storeImage(Request $request) {
        $reqData = $request->all();
        $response = new ServiceResponse();

        $response->Data = Media::get($this->setMedia($reqData, 'image', ''));

        $response->IsSuccess = true;
        $response->Message = 'Saved successfully.';
        return $this->GetJsonResponse($response);
    }

}
