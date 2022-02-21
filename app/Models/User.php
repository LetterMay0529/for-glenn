<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $primaryKey = 'users_id';
    
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'gender',
        'date_of_birth',
        'rank',
        'email',
        'username',
        'profile_img',
        'phone',
        'status',
        'password',
        'about_me',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at',
        'phone_verified_at',
        'date_verified_at',
    ];

    protected $dateFormat = 'Y-m-d';
}
