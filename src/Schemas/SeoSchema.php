<?php

namespace Webdecero\Webcms\Schemas;

use Webdecero\Webcms\Schemas\BaseSchema;

class SeoSchema extends BaseSchema
{
    public $title;
    public $description;
    public $metaTag;
    public $image;
    public $schema;

    function __construct(String $title, String $description, Array $metaTag, String $image, String $schema) {
        $this->title = $title;
        $this->description = $description;
        $this->metaTag = $metaTag;
        $this->image = $image;
        $this->schema = $schema;
    }

}