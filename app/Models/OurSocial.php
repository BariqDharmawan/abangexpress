<?php

namespace App\Models;

use App\Helper\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class OurSocial extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'platform',
        'username',
        'link',
        'domain_owner'
    ];
}
