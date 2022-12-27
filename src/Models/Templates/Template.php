<?php

namespace Webdecero\CMS\Models\Templates;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'keyName',
        'title',
        'type',
        'keyNameHeader',
        'keyNameFooter',
        'content',
        'css',
        'javaScript'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

}