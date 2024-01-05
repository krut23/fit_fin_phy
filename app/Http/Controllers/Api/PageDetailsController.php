<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Infrastructure\Media;
use App\Models\CardListing;
use App\Models\PageDetails;
use Validator;

class PageDetailsController extends BaseController
{


    public function details($key) {

        $pageConfigs = PageDetails::where('key', 'config')->first();
        $pageMenu = PageDetails::where('key', 'menu-builder')->first();
        $pageDetails = PageDetails::where('key', $key)->first();

        if (empty($pageDetails)) {
            $pageDetails = new PageDetails;
            $pageDetails->key = $key;
            $pageDetails->data = null;
            $pageDetails->save();
        }

        $data = json_decode($pageDetails->data, true);

        foreach (array_unique(IMAGES_KEYS) as $k){
            if(!empty($data[$k])) $data[$k] = Media::get($data[$k]);
        }

        $cardListing = CardListing::orderByDesc('id')->get()->toArray();
        $newCardsList = [];
        if ($cardListing) {

            foreach ($cardListing as $i => $row) {
                if(empty($newCardsList[$row['key']])) $newCardsList[$row['key']] = [];
                $row['image'] = Media::get($row['image']);
//                $cardListing[$i] = $row;
                array_push($newCardsList[$row['key']], $row);
            }
        }


        $resData = $data;
        $resData['pageConfigs'] = json_decode($pageConfigs->data, true);
        $resData['headerMenu'] = !empty($pageMenu) ? json_decode($pageMenu->data, true) : [];
        $resData['cards'] = $newCardsList;
        return $this->sendSuccess($resData);

    }


}

