<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Infrastructure\Media;
use App\Infrastructure\ServiceResponse;
use App\Models\PhoneBookUser;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;


class UserController extends BaseController
{
    public $pageTitle = ['s' => 'User', 'p' => 'Users'];

    public function expiredDate(){

        $users = PhoneBookUser::where('expires_at', '<=', Carbon::now())->where('last_login_at', '<', Carbon::now())->get();

    // Update the status of all users to 0.
    $users->each(function ($user) {
        $user->is_active = 0;
        $user->save();
    });

    return redirect()->back();
    }

    /**
     * Display a view
     * Method GET
     */
    public function index() {

        $clicksRouts = [];
        foreach (CLICK_KEYS as $key) {
            $clicksRouts[] = ['name' => ucwords(str_replace('-', ' ', $key)), 'url' => route('clicks', $key).'/'];
        }
        $viewData = [
            'pageTitle' => $this->pageTitle,
            'routes' => [
                'show' => route('users.show'),
//                'store' => route('school.store'),
//                'destroy' => route('school.destroy'),
//                'update' => route('school.update'),
            ],
            'breadcrumbs' => [ /*['label' => 'Dashboard', 'route' => route('dashboard')]*/],
            'clicksRouts' => $clicksRouts,
        ];

        return view('admin.common-list', [
            'title' => $this->pageTitle['p'],
            'jsController' => 'userCtrl',
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
        $pageData = [];
        $query = PhoneBookUser::query();

        // Apply filters [
        $query = $this->applyFilters($query, $reqData['dataTableFields'], $reqData['dataTableCommonSearch']);
        // ] Apply filters


        // Apply execution [
        list($isFound, $records, $reqData, $pageData) = $this->applyExecution($query, $reqData, $pageData);
        // Apply execution [

        if ($isFound) {
            $index = $reqData['startIndex'] + 1;
            foreach ($records as $i => $row) {
                $row['index'] = $index++;
//                $row['profile_url'] = Media::get($row['profile_url']);
                $records[$i] = $row;
            }
        }

        $pageData['filteredData'] = $records;

        $response->Data = $pageData;
        $response->IsSuccess = true;
        return $this->GetJsonResponse($response);
    }



}
