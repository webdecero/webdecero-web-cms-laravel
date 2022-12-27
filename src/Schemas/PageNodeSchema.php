<?php

namespace Webdecero\CMS\Schemas;

use Webdecero\CMS\Schemas\BaseSchema;

class PageNodeSchema extends BaseSchema
{
    
    public $menuTitle;
    public $slug;
    public $keyNamePage;
    public $keyNameTemplate;
    public $type;
    public $urlRedirec;
    public $target;
    public $isVisible;

    function __construct($data) {
        $this->name = $data['name'];
        $this->slug = $data['slug'];
        $this->keyNamePage = $data['keyNamePage'];
        $this->keyNameTemplate = $data['keyNameTemplate'];
        $this->type = $data['type'];
        $this->urlRedirec = $data['urlRedirec'];
        $this->target = $data['target'];
        $this->isVisible = $data['isVisible'];
    }

}