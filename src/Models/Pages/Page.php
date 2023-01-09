<?php

namespace Webdecero\Webcms\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $collection = 'webcms_pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'keyName',
        'lang',
        'content',
        'temporalContent',
        'seo',
        'css',
        'javaScript'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

}