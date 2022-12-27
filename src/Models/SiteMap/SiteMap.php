<?php

namespace Webdecero\Webcms\Models\SiteMap;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class SiteMap extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'keyNameSite',
        'lang',
        'map'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function addAttribute($attribute, $value) {
        $this->attributes[$attribute] = $value; 
    }

    public function removeAttribute($attribute) {
        unset($this->attributes[$attribute]);
    }
}