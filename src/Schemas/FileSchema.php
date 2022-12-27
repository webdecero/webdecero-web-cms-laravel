<?php

namespace Webdecero\CMS\Schemas;

use Webdecero\CMS\Schemas\BaseSchema;

class FileSchema extends BaseSchema
{
    public $_id;
    public $name;
    public $pathFile;
    public $type;
    public $order;

    function __construct(String $name, String $pathFile, String $type, int $order) {
        $this->_id = (string) new \MongoDB\BSON\ObjectId();
        $this->name = $name;
        $this->pathFile = $pathFile;
        $this->type = $type;
        $this->order = $order;
    }
}