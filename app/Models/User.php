<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'username',
        'password',
        'plain_password',
        'domain_owner',
        'code_api',
        'token_api',
        'lt'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'plain_password'
    ];

    public function aboutUs()
    {
        return $this->hasMany('App\Models\AboutUs', 'id');
    }

    public function templateChoosen()
    {
        return $this->hasOne(TemplateChoosen::class);
    }

    public static function getKeyApi()
    {
        $postdata = [
            'akun' => auth()->user()->code_api,
            'key' => auth()->user()->token_api
        ];

        return json_encode($postdata);
    }

}
