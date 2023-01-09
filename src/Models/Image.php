<?php

namespace Webdecero\Webcms\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Image extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $collection = 'webcms_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'thumbName',
        'originalName',
        'alt',
        'title',
        'extension',
        'pathFile',
        'thumbPathFile',
        'width',
        'height',
        'size',
        'orientation',
        'format',
        'disk',
        'isPublic',
        'folder',
        'quality',
        
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $casts = [

        'quality' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'size' => 'integer',
        'isPublic' => 'boolean'

    ];

    public function setisPublicAttribute($value)
    {

        if ($value === true || $value === 'true' || $value === 'TRUE' || $value === 1 || $value === '1') {
            $this->attributes['isPublic'] = true;
        } else {
            $this->attributes['isPublic'] = false;
        }
    }

    public function setWidthAttribute($value)
    {
        $this->attributes['width'] = intval($value);
    }
    public function setSizeAttribute($value)
    {
        $this->attributes['size'] = intval($value);
    }
    public function setHeightAttribute($value)
    {
        $this->attributes['height'] = intval($value);
    }

    public function setQualityAttribute($value)
    {
        $this->attributes['quality'] = intval($value);
    }
}