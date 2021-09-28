<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    public $fillable = [
        'our_name',
        'our_vision',
        'our_mission',
        'address_embed',
        'our_video',
        'sub_slogan',
        'slogan',
        'cover_vision_mission' //
    ];
}
