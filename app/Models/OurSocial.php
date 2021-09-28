<?php

namespace App\Models;

use App\Helper\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class OurSocial extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'platform', 'username', 'link'];

    public static function generateUrl(string $username, $platform)
    {
        $linkPlatform = '';

        $socialMedias = Helper::getJson('social-media.json');
        $platforms = Arr::pluck($socialMedias, 'platform');
        $platforms = Arr::first($platforms, function ($value, $key) use($platform) {
            return $value === $platform;
        });

        $linkPlatform = Arr::first($socialMedias, function ($value, $key) use ($platform){
            return $value->platform == $platform;
        });

        return $linkPlatform;
    }
}
