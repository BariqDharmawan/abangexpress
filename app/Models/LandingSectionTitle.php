<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingSectionTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_us',
        'our_service',
        'contact_us',
        'our_team',
        'our_branch',
        'faq',
        'our_contact',
        'domain_owner'
    ];
}
