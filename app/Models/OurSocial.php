<?php

namespace App\Models;

use App\Helper\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class OurSocial extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'platform', 'username', 'link', 'user_id'];

    public static function generateUrl(string $username, $platform)
    {
        $linkPlatform = '';

        $socialMedias = Helper::getJson('social-media.json', true);
        $pickedPlatform = Arr::first(
            Helper::getListSocialPlatform(), function ($value, $key) use($platform) {
                return $value === $platform;
            }
        );

        //get link platform based on platform name
        $linkPlatform = Arr::first(
            $socialMedias, function ($socialMedia, $key) use ($pickedPlatform) {
                return $socialMedia['platform'] === $pickedPlatform;
            }
        );

        return $linkPlatform['link'] . '/' . $username;
    }
}
