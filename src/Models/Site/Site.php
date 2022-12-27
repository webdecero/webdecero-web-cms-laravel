<?php

namespace Webdecero\CMS\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Site extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'keyName',
        'settings',
        'seo',
        'css',
        'javaScript',
        'siteMap'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

}