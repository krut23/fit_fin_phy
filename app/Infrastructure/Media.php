<?php

namespace App\Infrastructure;

use Illuminate\Support\Facades\Storage;

//use Image;

class Media
{
    public static $secret_ = 'wAPKjsghFhg81EffYz';
    public static $secret_key = 'jPG15eExf6DW7nygqKARnfgQ2776KTc2YEJviYBRoghfg7K5R1anBIMKXvM';
    public static $adminProfileFolder = 'admin-profile';
    public static $userMediaFolder = '';
    public static $defaultImageName = 'profile.png';


    // Store file in disk
    public static function fileStore($targetDir, $file, $fileNewName = ''){
        $targetDir = 'storage/app/' . $targetDir . '/';
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        if (empty($fileNewName)) {
            $fileExtension = $file->getClientOriginalExtension();
            $fileNewName = $fileExtension . '_' . time() . str_replace('.', '', uniqid(rand(), true)) . '.' . $fileExtension;
            $file->move($targetDir, $fileNewName);
        } else {
            file_put_contents($targetDir . $fileNewName, $file);
        }
        return $fileNewName;
    }

    // Base 64 file decode
    public static function fileDecode($dirName, $image){
//        $fileNewName = 'img_'.time().str_replace('.', '',uniqid(rand(),true)).'.png';
        $fileNewName = 'img_' . time() . str_replace('.', '', uniqid(rand(), true));
        $fileExtension = '.png';
        // Image File
        if (strpos($image, 'data:image/jpeg;base64,') !== false) {
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $fileExtension = '.jpeg';

        } else if (strpos($image, 'data:image/png;base64,') !== false) {
            $image = str_replace('data:image/png;base64,', '', $image);
            $fileExtension = '.png';

        } else if (strpos($image, 'data:image/webp;base64,') !== false) {
            $image = str_replace('data:image/webp;base64,', '', $image);
            $fileExtension = '.webp';

        } else if (strpos($image, 'data:image/jpg;base64,') !== false) {
            $image = str_replace('data:image/jpg;base64,', '', $image);
            $fileExtension = '.jpg';

        } else if (strpos($image, 'data:image/gif;base64,') !== false) {
            $image = str_replace('data:image/gif;base64,', '', $image);
            $fileExtension = '.gif';

        } else if (strpos($image, 'data:image/svg+xml;base64,') !== false) {
            $image = str_replace('data:image/svg+xml;base64,', '', $image);
            $fileExtension = '.svg';
        }
//        else {
//            $fileExtension= '.png';
//        }
        $fileNewName .= $fileExtension;
        $image = base64_decode($image);
        $fileNewName = self::fileStore($dirName, $image, $fileNewName);

        return $fileNewName;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////

    // Get static image
    // Default image
    public static function getDefaultImage($imageName = null){
        if(empty($imageName)) $imageName = self::$defaultImageName;
        return asset('storage/app/default/' . $imageName);
    }

    ////////////////////////////////////////////////////////////////////////////////
    // File Manager file
//    public static function getFileManagerFile($fileName){
//        return !empty($fileName) ? asset('storage/app/'.self::$fileManagerFolder.'/'.$fileName) : '';
//    }
//
//    public static function storeFileManagerFile($file){
//        $fileName = self::fileStore(self::$fileManagerFolder,$file);
//        return $fileName;
//    }
//
//    public static function deleteFileManagerFile($fileName){
//        if (empty($imageList)) return;
//        if (!is_array($imageList)) $imageList = [$imageList];
//        foreach ($imageList as $image) Storage::delete(self::$fileManagerFolder.'/'.$image);
//    }

    // Admin Profile Image
    public static function getAdminProfileImage($imageName){
        return !empty($imageName) ? asset('storage/app/' . self::$adminProfileFolder . '/' . $imageName) : '';
    }

    public static function storeAdminProfileImage($image){
        $fileName = self::fileDecode(self::$adminProfileFolder, $image);
        return $fileName;
    }

    public static function deleteAdminProfileImage($imageList){
        if (empty($imageList)) return;
        if (!is_array($imageList)) $imageList = [$imageList];
        foreach ($imageList as $image) Storage::delete(self::$adminProfileFolder . '/' . $image);
    }


    // Project Media
    public static function get($imageName){
        return !empty($imageName) ? asset('storage/app' . self::$userMediaFolder . '/' . $imageName) : self::getDefaultImage();
    }

    public static function store($image){
        $fileName = self::fileStore(self::$userMediaFolder, $image);
        return $fileName;
    }

    public static function delete($imageList){
        if (empty($imageList)) return;
        if (!is_array($imageList)) $imageList = [$imageList];
        foreach ($imageList as $image) Storage::delete(self::$userMediaFolder . '/' . $image);
    }

    public static function storeImage($image){
        $fileName = self::fileDecode(self::$userMediaFolder, $image);
        return $fileName;
    }

    public static function deleteImage($imageList){
        if (empty($imageList)) return;
        if (!is_array($imageList)) $imageList = [$imageList];
        foreach ($imageList as $image) Storage::delete(self::$userMediaFolder . '/' . $image);
    }

    // use all common function based on folder name

    // Static Image
//    public static function getPdfImage($imageName){
//        return !empty($imageName) ? asset('storage/app/pdf-image/'.$imageName) : '';
//    }

//    public static function getMediaForPdf($fileName){
//        return storage_path('app/' . self::$userMediaFolder . '/' . $fileName);
//    }

}
