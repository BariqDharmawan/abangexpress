<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingSectionDesc extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_desc_about_us',
        'second_desc_about_us',
        'first_desc_contact_us',
        'domain_owner'
    ];
}
