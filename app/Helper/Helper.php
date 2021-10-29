<?php

namespace App\Helper;

use Carbon\Carbon;
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

    public static function responseDataOrder($res)
    {
        return collect($res)->map(function ($item, $key){
            return [
                'noresi' => $item->noresi,
                'pengirim' => $item->pengirim,
                'telepon' => $item->telepon,
                'penerima' => $item->penerima,
                'teleponp' => $item->teleponp,
                'alamat' => $item->alamat,
                'tujuan' => $item->tujuan,
                'berat' => $item->berat,
                'qty' => $item->qty,
                'token' => $item->token,
                'tglOrder' => Carbon::parse($item->tglOrder)->format('d F Y')
            ];
        });
    }

    public static function checkOrderStatus($data, $statusToCheck)
    {
        return strpos(strtolower($data), $statusToCheck) !== false;
    }

    public static function removeMenuIfContentEmpty($menus, $dataAttached, $menuToRemove)
    {
        if (count($dataAttached) == 0) {
            $menus = $menus->filter(function ($menu) use ($menuToRemove) {
                return $menu->url != $menuToRemove;
            });
        }

        return $menus;
    }

}
