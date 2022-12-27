<?php

namespace Webdecero\Webcms\Schemas;

use Webdecero\Webcms\Schemas\BaseSchema;

class CustomFileSchema extends BaseSchema
{
    
    public $name;
    public $pathFile;

    function __construct(String $name, String $pathFile) {
        $this->name = $name;
        $this->pathFile = $pathFile;
    }

}