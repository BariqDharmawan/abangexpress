<?php

namespace App\Helper;

use Illuminate\Support\Arr;

class Helper 
{
    public static function getJson($json, $isToArray = false) {
        return json_decode(file_get_contents('json/' . $json), $isToArray);
    }

    public static function getListSocialPlatform()
    {
        $socialMedia = self::getJson('social-media.json', true);
        $platforms = Arr::pluck($socialMedia, 'platform');
        return $platforms;
    }
}