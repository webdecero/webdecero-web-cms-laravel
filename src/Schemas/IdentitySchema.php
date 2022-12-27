<?php

namespace Webdecero\CMS\Schemas;

use Webdecero\CMS\Schemas\BaseSchema;

class IdentitySchema extends BaseSchema
{
    public $logo;
    public $color;

    function __construct(String $logo, String $color) {
        $this->logo = $logo;
        $this->color = $color;
    }
}