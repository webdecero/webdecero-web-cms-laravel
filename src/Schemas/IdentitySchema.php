<?php

namespace Webdecero\Webcms\Schemas;

use Webdecero\Webcms\Schemas\BaseSchema;

class IdentitySchema extends BaseSchema
{
    public $logo;
    public $color;

    function __construct(String $logo, String $color) {
        $this->logo = $logo;
        $this->color = $color;
    }
}