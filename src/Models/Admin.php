<?php

namespace Webdecero\Webcms\Models;

// use Laravel\Sanctum\HasApiTokens;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Admin extends Authenticatable
{
    use SoftDeletes;

    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    //    protected $table = 'users';
    protected $dates = ['deleted_at'];


    protected $collection = 'webcms_admin';

    const STATUS_TRUE = true;
    const STATUS_FALSE = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'image',
        'description',
        'position',
    ];
    protected $guarded = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];



    public function setPasswordAttribute($value)
    {

        $this->attributes['password'] = Hash::make($value);
    }
}