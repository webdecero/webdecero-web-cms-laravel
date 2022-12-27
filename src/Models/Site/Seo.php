<?php

namespace Webdecero\Webcms\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Seo extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'es'
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