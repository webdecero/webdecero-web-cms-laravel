<?php

namespace Webdecero\Webcms\Schemas;

use Webdecero\Webcms\Schemas\BaseSchema;

class SettingsSchema extends BaseSchema
{
    public $name;
    public $urlBase;
    public $lang;
    public $robots;
    public $favicon;

    function __construct(String $name, String $urlBase, String $lang, String $robots, String $favicon) {
        $this->name = $name;
        $this->urlBase = $urlBase;
        $this->lang = $lang;
        $this->robots = $robots;
        $this->favicon = $favicon;
    }

}