<?php

namespace Webdecero\CMS\Schemas;

use Webdecero\CMS\Schemas\BaseSchema;
use Webdecero\CMS\Schemas\CustomFileSchema;

class FrontEndFilesSchema extends BaseSchema
{
    
    public $files = [];
    public $custom = '';

    function __construct(Array $files = [], String $name, String $pathFile) {
        $this->files = $files;
        $this->custom =  new CustomFileSchema($name, $pathFile);
    }

    function addFile($file) {
        array_push($this->files, $file);
    }

    function getFile($id) {
        foreach($this->files as $file) {
            if($file['_id'] == $id) {
                return $file;
            }
        }
        throw new \Exception('Archivo no encontrado', 404);
    }

    function updateFile($id, $input) {
        foreach($this->files as &$file) {
            if($file['_id'] == $id) {
                $file['name'] = $input['name'];
                $file['pathFile'] = $input['pathFile'];
                $file['type'] = $input['type'];
                $file['order'] = $input['order'];
                return $file;
            }
        }
        throw new \Exception('Archivo no encontrado', 404);
    }

    function removeFile($id) {
        //get file
        $file = $this->getFile($id);
        //getOrder
        $order = $file['order'];
        //get index of file
        $index = array_search($file, $this->files);
        if(!isset($index)) throw new \Exception('Archivo no encontrado', 404);
        //remove element
        unset($this->files[$index]);
        //reindex array
        $this->files = array_values($this->files);
        //reorder array
        $this->_reorder($order);

        return $file['pathFile'];
    }

    private function _reorder($order){
        foreach($this->files as &$file){
            if(intval($file['order']) > intval($order)) $file['order'] = intval($file['order']) - 1;
        }
    }
    
    function addCustom(String $name, String $pathFile) {
        $this->custom =  new CustomFileSchema($name, $pathFile);
    }
}