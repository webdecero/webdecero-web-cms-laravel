<?php

namespace Webdecero\Webcms\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Settings extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $collection = 'webcms_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sideBar',
        'login'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

}