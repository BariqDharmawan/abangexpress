<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Helper
{
    public static function getJson($json, $isToArray = false) {
        return json_decode(file_get_contents(public_path('json/' . $json)), $isToArray);
    }

    public static function getListSocialPlatform()
    {
        $socialMedia = self::getJson('social-media.json', true);
        $platforms = Arr::pluck($socialMedia, 'platform');
        return $platforms;
    }

    public static function getListSocialLink()
    {
        $socialMedia = self::getJson('social-media.json', true);
        $links = Arr::pluck($socialMedia, 'link');
        return $links;
    }

    public static function returnSuccess($message)
    {
        return redirect()->back()->with('success', "Successfully $message");
    }
}