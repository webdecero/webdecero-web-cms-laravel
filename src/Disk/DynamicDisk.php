<?php

namespace Webdecero\Webcms\Disk;

use Illuminate\Support\Facades\Storage;

class DynamicDisk
{
    
    function createDisk() {
        return $disk = Storage::build([
            'driver' => 'local',
            'root' => storage_path('app/CMS-WDC'),
        ]);
    }

}