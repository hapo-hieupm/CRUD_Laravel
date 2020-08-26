<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    public const GENDERS = [
        0 => 'Male',
        1 => 'Female'
     ];

    public static function getGender($gender)
    {
        return array_search($gender, self::GENDERS);
    }   
    
    public function getGenderValueAttribute()
    {
        return self::GENDERS[ $this->attributes['gender'] ];
    } 

    protected $fillable = [
        'name',
        'email',
        'password',
        'ava',
        'gender',
        'address',
        'phone',
        'birthday',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $dates = [
        'deleted_at'
    ];
}
