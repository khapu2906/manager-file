<?php

namespace Khapu\Directory\Traits\Events;
use Exception;

trait OpenEvent
{
    private function _format($subPath)
    {
        $d = [];
        $path = $this->fullPath . $subPath;
        foreach ($this->usedAttributes as $attribute) {
            switch ($attribute) {
                case 'name': 
                    $d[$attribute] = basename($path);
                    break;
                case 'basePath':
                    $d[$attribute] = $this->fullPath;
                    break;
                case 'fullPath':
                    $d[$attribute] = $path;
                    break;
                case 'subPath':
                    $d[$attribute] = ($subPath !== '') ? basename($path) : $subPath;
                    break;
                case 'type':
                    $privateType = (filetype($path) == 'dir') ? filetype($path) : $this->type($path);
                    $arr = explode('/', $privateType);
                    $typeArr['synthetic'] = $arr[0];                            
                    $typeArr['detail'] = data_get($arr, '1', $arr[0]);   
                    $d[$attribute] = (object)$typeArr;
                    break;
                case 'content':
                    $d['content'] = 'undefined';
                    break;
                case 'size':
                case 'unitSize':
                    $sizeConvert = $this->formatSizeData($this->size($path, true));
                    $d[$attribute] = ($attribute == 'size') ? $sizeConvert['value'] : $sizeConvert['unit'];
                    break;
                case 'permission': 
                    $d[$attribute] = fileperms($path);
                    break;
                case 'modifiedAt': 
                    $d[$attribute] = date('F d Y H:i:s', filemtime($path));
                    break;
                case 'inodeChangeAt': 
                    $d[$attribute] = date('F d Y H:i:s', filectime($path));
                    break;  
                case 'accessedAt': 
                    $d[$attribute] = date('F d Y H:i:s', fileatime($path));
                    break;    
            }
        }
        return $d;
    }

    public function open(bool $getContent = false)
    {   
        // try{
            switch (filetype($this->fullPath)) {
                case 'dir': 
                    $listDir = scandir($this->fullPath);
                    $this->count = count($listDir);
                    foreach ($listDir as $k => $v) {
                        $d = $this->_format('/' . $v);
                        $status = $this->_checkWhere($d);
                        if ($status) {
                            $this->setOnlyData((object)$d);
                        }
                    }
                    break;
                default:
                    $d = $this->_format('');
                    $this->setOnlyData((object)$d);
                    break;
            }
            return $this;
        // } catch (Exception $e) {
        //     throw new Exception("Dir not found");
        // }    
    }


}
