<?php

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;


if (!function_exists('uploadFile')) {

    function uploadFile($requestFile, $width, $height, $savePath)
    {
        $name_gen = hexdec(uniqid()) . '.' . $requestFile->getClientOriginalExtension();
        // create image manager with desired driver
        $manager = new ImageManager(new Driver());
        // read image from file system
        $image = $manager->read($requestFile);
        // resize image proportionally to 300px width
        $image->resize($width, $height);
        // insert watermark
        // $image->place('images/watermark.png');
        // save modified image in new format
        $image->toJpeg()->save(base_path('public/' . $savePath . $name_gen));
        $save_url = $savePath . $name_gen;
        return $save_url;
    }
}


if (!function_exists('uploadSettingsImg')) {

    function uploadSettingsImg($requestFile, $savePath)
    {
        $name_gen = hexdec(uniqid()) . '.' . $requestFile->getClientOriginalExtension();
        // create image manager with desired driver
        $manager = new ImageManager(new Driver());
        // read image from file system
        $image = $manager->read($requestFile);
        // resize image proportionally to 300px width
        // $image->resize($width, $height);
        // insert watermark
        // $image->place('images/watermark.png');
        // save modified image in new format
        $image->save(base_path('public/' . $savePath . $name_gen));
        $save_url = $savePath . $name_gen;
        return $save_url;
    }
}





/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('convertYmdToMdy')) {
    function convertYmdToMdy($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('m-d-Y');
    }
}

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('convertMdyToYmd')) {
    function convertMdyToYmd($date)
    {
        return Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }
}
