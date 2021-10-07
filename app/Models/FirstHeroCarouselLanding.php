<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstHeroCarouselLanding extends Model
{
    use HasFactory;

    public $fillable = ['img', 'user_id', 'domain_owner'];
}
