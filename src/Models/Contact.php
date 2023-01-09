<?php

namespace Webdecero\Webcms\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $collection = 'webcms_contacts';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];


    protected $attributes = [
        'phone' => '',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // protected $casts = [
    //     'created_at' => 'date:d-m-Y',
    //     'updated_at' => 'date:d-m-Y',
    // ];
}