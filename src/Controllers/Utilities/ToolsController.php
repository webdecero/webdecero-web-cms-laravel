<?php

namespace Webdecero\Webcms\Controllers\Utilities;

use Exception;
use Throwable;
use Validator;
use Webdecero\Webcms\Disk\DynamicDisk;
use Illuminate\Http\Request;
use Webdecero\Webcms\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ToolsController extends Controller
{
    use ResponseApi;

    
    public function getPath($name, $path = null, $extension = null)
    {
        if ($path) {
            $path = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        }

        $ext = (is_null($extension)) ? '' : '.' . $extension;

        return $path . $name . $ext;
    }

    public function updateCustomFile($folder, $name, $type, $content) {
        $dynamicDisk = new DynamicDisk();
        $disk = $dynamicDisk->createDisk();

        $path = $this->getPath($name, $folder, $type);
        $isSave = $disk->put($path, $content);
        if (!$isSave) throw new \Exception('No storage', 500);
        return 'CMS-WDC/'.$path;
        
    }

    public function getContentCustomFile($folder, $name, $type) {
        $dynamicDisk = new DynamicDisk();
        $disk = $dynamicDisk->createDisk();

        $path = $this->getPath($name, $folder, $type);
        if (!$disk->exists($path)) return '';

        $content = $disk->get($path);
        
        return $content;
    }

    public function removeFile($path) {
        $dynamicDisk = new DynamicDisk();
        $disk = $dynamicDisk->createDisk();

        $path = str_replace('CMS-WDC/', '', $path);

        $disk->delete($path);
        
    }

    //Cast array to specific class
    public function getFrontEndFilesSchema($array)
    {
        $objectSTD =  (object)$array;

        return $this->_cast($objectSTD, 'Webdecero\Webcms\Schemas\FrontEndFilesSchema');
    }

    //Cast std class to specific class
    private function _cast($instance, $className)
    {
        return unserialize(sprintf(
            'O:%d:"%s"%s',
            \strlen($className),
            $className,
            strstr(strstr(serialize($instance), '"'), ':')
        ));
    }

    //Generate a random string
    public function getKeyName($length = 32)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->_crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }

    private function _crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    

}