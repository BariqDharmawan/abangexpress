<?php

namespace App\Helper;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
        return redirect()->back()->with('success', "Berhasil $message");
    }

    public const DUMMY_DOMAINS = [
        'http://127.0.0.1:8000',
        'http://127.0.0.1:9000'
    ];

    public static function getKeyApi()
    {
        $postdata = [
            'akun' => auth()->user()->code_api,
            'key' => auth()->user()->token_api
        ];

        return json_encode($postdata);
    }

    public static function getKeyApiArray()
    {
        return [
            'akun' => auth()->user()->code_api,
            'key' => auth()->user()->token_api
        ];
    }

    public static function logout()
    {
        Auth::guard('web')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();
    }
}