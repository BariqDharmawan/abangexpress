<?php

namespace App\Helper;

class Helper 
{
    public static function getJson($json, $isToArray = false) {
        return json_decode(file_get_contents('json/' . $json), $isToArray);
    }
}