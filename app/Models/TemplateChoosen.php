<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateChoosen extends Model
{
    use HasFactory;

    protected $fillable = ['domain_owner', 'version'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTemplateNameAttribute()
    {
        if ($this->version == 2) {
            return "Just Blue";
        }
        else {
            return "Pure White";
        }
    }
}
