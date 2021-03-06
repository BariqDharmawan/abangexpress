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
        'sub_slogan',
        'slogan',
        'cover_vision_mission',
        'domain_owner'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
