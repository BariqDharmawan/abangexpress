<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurBranch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon', 'telephone', 'address', 'domain_owner'];
}
