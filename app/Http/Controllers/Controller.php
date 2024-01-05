<?php

namespace App\Http\Controllers;

//use App\Models\Metadata;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Infrastructure\Media;
use App\Infrastructure\ServiceResponse;
use Illuminate\Support\Facades\Auth;
use Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // meta validation array
//    public $validationMeta = [
//                'id' => 'required',
//                'meta_title' => 'max:60',
//                'meta_description' => 'max:160',
//                'meta_keywords' => 'max:160',
//                'itemprop_name' => 'max:60',
//                'itemprop_description' => 'max:160',
//                'itemprop_keywords' => 'max:160',
//                'og_title' => 'max:60',
//                'og_description' => 'max:160',
//                'twitter_title' => 'max:60',
//                'twitter_description' => 'max:160',
//            ];

    // set media files
    public function getCurrentTime() {
        $currentTime = Carbon::now();
        return $currentTime->format('Y-m-d H:i:s');
    }
    public function setMediaFile($reqData, $methodLabel, $fileKey, $dbFile)
    {

        $delete = 'delete' . $methodLabel;
        $store = 'store' . $methodLabel;
        $reqData['deleteFileList'] = gettype($reqData['deleteFileList']) == 'string' ? json_decode($reqData['deleteFileList']) : $reqData['deleteFileList'];
        if (!empty($reqData['deleteFileList']) && in_array($fileKey, $reqData['deleteFileList'])) {
            Media::$delete($dbFile);
            return null;
        } else {
            if (!empty($reqData[$fileKey])) {
                if (!empty($dbFile)) {
                    Media::$delete($dbFile);
                }
                $reqData[$fileKey] = is_array($reqData[$fileKey]) && !empty($reqData[$fileKey]) ? $reqData[$fileKey][0] : $reqData[$fileKey];
                return Media::$store($reqData[$fileKey]);
            } else {
                return $dbFile;
            }
        }
    }

    // set media files
    public function setMedia($reqData, $fileKey, $dbFile, $methodLabel = 'Image')
    {

        $delete = 'delete' . $methodLabel;
        $store = 'store' . $methodLabel;

        if (!empty($reqData[$fileKey])) {
            if (!empty($dbFile)) {
                Media::$delete($dbFile);
            }
            $reqData[$fileKey] = is_array($reqData[$fileKey]) && !empty($reqData[$fileKey]) ? $reqData[$fileKey][0] : $reqData[$fileKey];
            return Media::$store($reqData[$fileKey]);
        } else {
            return $dbFile;
        }
    }

    // get media files
    public function getMediaFile($row, $methodLabel, $fileKey, $default = null)
    {
        $get = 'get' . $methodLabel;
        return !empty($row[$fileKey]) ? Media::$get($row[$fileKey]) : $default;
    }

    // Set meta and record object
//    public function setMetaRecord($record, $reqData){
//        $response = new ServiceResponse();
//
//        $record->meta_title = valueNull($reqData['meta_title']);
//        $record->meta_description = valueNull($reqData['meta_description']);
//        $record->meta_keywords = valueNull($reqData['meta_keywords']);
//
//        $record->itemprop_name = valueNull($reqData['itemprop_name']);
//        $record->itemprop_description = valueNull($reqData['itemprop_description']);
//        $record->itemprop_keywords = valueNull($reqData['itemprop_keywords']);
//        $record->itemprop_url = valueNull($reqData['itemprop_url']);
//
//        $record->og_title = valueNull($reqData['og_title']);
//        $record->og_description = valueNull($reqData['og_description']);
//        $record->og_url = valueNull($reqData['og_url']);
//
//        $record->twitter_title = valueNull($reqData['twitter_title']);
//        $record->twitter_description = valueNull($reqData['twitter_description']);
//        $record->twitter_card = valueNull($reqData['twitter_card']);
//        $record->twitter_site = valueNull($reqData['twitter_site']);
//
//        $record->og_image = $this->setMediaFile($reqData, 'MetaOgImage', 'og_image', $record->og_image);
//        $record->twitter_image = $this->setMediaFile($reqData, 'MetaTwitterImage', 'twitter_image', $record->twitter_image);
//
//        $record->save();
//        $response->IsSuccess = true;
//        $response->Message = 'Meta updated successfully.';
//        return $response;
//    }

    // get meta info from record
//    public function getMetaObj($record = null){
//        if (empty($record)) {
//            $routeName = Route::currentRouteName();
//            $record = Metadata::where(['route_name' => $routeName, 'is_active' => 1])->first();
////            if (empty($record)) {
////                $record = Metadata::where(['route_name' => 'general'])->first();
////            }
//        }
//        return [
//            'meta_title' => !empty($record['meta_title']) ? $record['meta_title'] : '',
//            'meta_description' => !empty($record['meta_description']) ? $record['meta_description'] : '',
//            'meta_keywords' => !empty($record['meta_keywords']) ? $record['meta_keywords'] : '',
//            'itemprop_name' => !empty($record['itemprop_name']) ? $record['itemprop_name'] : '',
//            'itemprop_description' => !empty($record['itemprop_description']) ? $record['itemprop_description'] : '',
//            'itemprop_keywords' => !empty($record['itemprop_keywords']) ? $record['itemprop_keywords'] : '',
//            'itemprop_url' => !empty($record['itemprop_url']) ? $record['itemprop_url'] : '',
//            'og_title' => !empty($record['og_title']) ? $record['og_title'] : '',
//            'og_description' => !empty($record['og_description']) ? $record['og_description'] : '',
//            'og_url' => !empty($record['og_url']) ? $record['og_url'] : '',
//            'og_image' => !empty($record['og_image']) ? Media::getMetaOgImage($record['og_image']) : '',
//            'twitter_title' => !empty($record['twitter_title']) ? $record['twitter_title'] : '',
//            'twitter_description' => !empty($record['twitter_description']) ? $record['twitter_description'] : '',
//            'twitter_card' => !empty($record['twitter_card']) ? $record['twitter_card'] : '',
//            'twitter_site' => !empty($record['twitter_site']) ? $record['twitter_site'] : '',
//            'twitter_image' => !empty($record['twitter_image']) ? Media::getMetaTwitterImage($record['twitter_image']) : '',
//        ];
//    }


    // Make filter object
    public function applyFilters($query, $dataModalFields, $dataTableCommonSearch = null)
    {
        // dd($dataModalFields);

        // common search
        if ($dataTableCommonSearch) {
            foreach ($dataModalFields as $key => $row) {
                if (array_key_exists('searchType', $row) &&
                    array_key_exists('isSearchable', $row) && $row['isSearchable']
                ) {

                    $key = !empty($row['schemaColumn']) ? $row['schemaColumn'] : $key;
                    $row['val'] = is_string($dataTableCommonSearch) ? trim($dataTableCommonSearch) : $dataTableCommonSearch;
                    if (array_key_exists('schemaName', $row) && !empty($row['schemaName'])) {
                        $query = $query->whereHas($row['schemaName'], function ($q) use ($key, $row) {
                            // $q->where($row['schemaColumn'],'LIKE','%'.$row['val'].'%');
                            if ($row['searchType'] == 'id') {
                                $q = $q->orWhere($row['schemaColumn'], $row['val']);
                            } elseif ($row['searchType'] == 'like') {
                                $q = $q->orWhere($row['schemaColumn'], 'LIKE', '%' . $row['val'] . '%');
                            } elseif ($row['searchType'] == 'date-range') {
                                if (!empty($row['val']['from'])) {
                                    $from_date = date('Y-m-d H:i:s', strtotime($row['val']['from']));
                                    $q = $q->whereDate($row['schemaColumn'], '>=', $from_date);
                                }
                                if (!empty($row['val']['to'])) {
                                    $to_date = date('Y-m-d H:i:s', strtotime($row['val']['to'] . ' +1 day'));
                                    $q = $q->whereDate($row['schemaColumn'], '<=', $to_date);
                                }

                            } else {
                                $q = $q->orWhere($row['schemaColumn'], 'LIKE', '%' . $row['val'] . '%');
                            }
                        });

                    } else {
                        $query = $query->orWhere(function ($q) use ($key, $row) {
                            if ($row['searchType'] == 'id') {
                                $q = $q->orWhere($key, $row['val']);
                            } elseif ($row['searchType'] == 'like') {
                                $q = $q->orWhere($key, 'LIKE', '%' . $row['val'] . '%');
                            } elseif ($row['searchType'] == 'date-range') {
                                if (!empty($row['val']['from'])) {
                                    // $from_date = trim($row['val']['from']);
                                    $from_date = date('Y-m-d H:i:s', strtotime($row['val']['from']));
                                    $q = $q->whereDate($key, '>=', $from_date);
                                }
                                if (!empty($row['val']['to'])) {
                                    $to_date = date('Y-m-d H:i:s', strtotime($row['val']['to'] . ' +1 day'));
                                    $q = $q->whereDate($key, '<=', $to_date);
                                }

                            } else {
                                $q = $q->orWhere($key, 'LIKE', '%' . $row['val'] . '%');
                            }
                        });

                    }

                }

            }
            return $query;
        }

        // individual search
        foreach ($dataModalFields as $key => $row) {
            if (array_key_exists('val', $row) &&
                array_key_exists('searchType', $row) &&
                array_key_exists('isSearchable', $row) &&
                isset($row['val']) && $row['isSearchable']
            ) {
                $key = !empty($row['schemaColumn']) ? $row['schemaColumn'] : $key;
                $row['val'] = is_string($row['val']) ? trim($row['val']) : $row['val'];
                if (array_key_exists('schemaName', $row) && !empty($row['schemaName'])) {
                    $query = $query->whereHas($row['schemaName'], function ($q) use ($key, $row) {
                        // $q->where($row['schemaColumn'],'LIKE','%'.$row['val'].'%');
                        if ($row['searchType'] == 'id') {
                            $q = $q->where($row['schemaColumn'], $row['val']);
                        } elseif ($row['searchType'] == 'like') {
                            $q = $q->where($row['schemaColumn'], 'LIKE', '%' . $row['val'] . '%');
                        } elseif ($row['searchType'] == 'date-range') {
                            if (!empty($row['val']['from'])) {
                                $from_date = date('Y-m-d H:i:s', strtotime($row['val']['from']));
                                $q = $q->whereDate($row['schemaColumn'], '>=', $from_date);
                            }
                            if (!empty($row['val']['to'])) {
                                $to_date = date('Y-m-d H:i:s', strtotime($row['val']['to'] . ' +1 day'));
                                $q = $q->whereDate($row['schemaColumn'], '<=', $to_date);
                            }

                        } else {
                            $q = $q->where($row['schemaColumn'], 'LIKE', '%' . $row['val'] . '%');
                        }
                    });

                } else {
                    $query = $query->where(function ($q) use ($key, $row) {
                        if ($row['searchType'] == 'id') {
                            $q = $q->where($key, $row['val']);
                        } elseif ($row['searchType'] == 'like') {
                            $q = $q->where($key, 'LIKE', '%' . $row['val'] . '%');
                        } elseif ($row['searchType'] == 'date-range') {
                            if (!empty($row['val']['from'])) {
                                // $from_date = trim($row['val']['from']);
                                $from_date = date('Y-m-d H:i:s', strtotime($row['val']['from']));
                                $q = $q->whereDate($key, '>=', $from_date);
                            }
                            if (!empty($row['val']['to'])) {
                                $to_date = date('Y-m-d H:i:s', strtotime($row['val']['to'] . ' +1 day'));
                                $q = $q->whereDate($key, '<=', $to_date);
                            }

                        } else {
                            $q = $q->where($key, 'LIKE', '%' . $row['val'] . '%');
                        }
                    });

                }

            }

        }
        return $query;
    }

    // Apply Execution
    public function applyExecution($query, $reqData, $pageData)
    {
        $searchParams = $reqData['searchParams'];
        // Count rows [
        $pageData['totalRecords'] = $reqData['totalItems'];
        if ($reqData['isCount']) {
            $countQuery = clone $query;
            $pageData['totalRecords'] = $countQuery->count();
        }
        // ] Count rows

        // Short rows [
        if (array_key_exists('short_order', $searchParams) && !empty($searchParams['short_order'])) {
            $shortingOrder = $searchParams['short_order']['shorting_order'];
            $columnName = $searchParams['short_order']['column_name'];
            ($shortingOrder != 'DESC') ? $query->orderBy($columnName) : $query->orderByDesc($columnName);
        } else {
            $query->orderByDesc('id');
        }
        // ] Short rows

        // Get records [
        if ($reqData['isAllRecords']) {
            $records = $query->get()->toArray();
        } else {
            $records = $query->take($reqData['pageSize'])->offset($reqData['startIndex'])->get()->toArray();
        }

        $isFound = count($records) > 0;
        return [$isFound, $records, $reqData, $pageData];
    }

    // Get Referrer Code
    public function getReferrerCode($length = 6)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $isUnique = Customer::where('referral_code', $randomString)->first();
        if (!empty($isUnique)) {
            $this->getReferrerCode();
        }

        return $randomString;
    }

    // Find user
    public function getUser()
    {
        $customerId = Auth::guard('api')->user()->id;
        return Customer::find($customerId);
    }
}
