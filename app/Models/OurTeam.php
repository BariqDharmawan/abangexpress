<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'avatar',
        'position_id',
        'short_desc',
        'domain_owner'
    ];

    public function position()
    {
        return $this->belongsTo('App\Models\PositionList', 'position_id');
    }
}
