<?php

namespace Khapu\Directory\Services;

use Khapu\Directory\Services\AbstractDirectory;
use Khapu\Directory\Services\InterfaceDirectory;
use Khapu\Directory\Traits\ConvertData;
use Exception;

final class DirectoryService extends AbstractDirectory implements InterfaceDirectory
{
    use ConvertData;

    public function dir()
    {
        $dir = dir($this->basePath);
        return $dir;
    }

    public function open(bool $getContent = false)
    {   
        try{
            // $subPath = ($subPath == '') ? '.' : $subPath;
            // if ($this->basePath == '') {
            //     $this->setPath($subPath);
            // } else {
            //     $this->setSubPath($subPath);
            // }
            $path = $this->buildPath($this->subPath);
            
            $type = (filetype($path) == 'dir') ? filetype($path) : $this->type($path);
            switch ($type) {
                case 'dir': 
                    $listDir = scandir($path);
                    $this->count = count($listDir);
                    foreach ($listDir as $k => $v) {
                        $d = [];
                        $pathName = ($this->subPath !== '') ? 
                            $this->buildPath($this->subPath . '/' . $v) :
                            $this->buildPath($v);
                        foreach ($this->usedAttributes as $attribute) {
                            switch ($attribute) {
                                case 'name': 
                                    $d[$attribute] = basename($v);
                                    break;
                                case 'basePath':
                                    $d[$attribute] = $pathName;
                                    break;
                                case 'subPath':
                                    $d[$attribute] = $this->subPath . "/" . $v;
                                    break;
                                case 'type':
                                    $privateType = (filetype($pathName) == 'dir') ? filetype($pathName) : $this->type($pathName);
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
                                    $sizeConvert = $this->formatSizeData($this->size($pathName, true));
                                    $d[$attribute] = ($attribute == 'size') ? $sizeConvert['value'] : $sizeConvert['unit'];
                                    break;
                                case 'permission': 
                                    $d[$attribute] = fileperms($pathName);
                                    break;
                                case 'modifiedAt': 
                                    $d[$attribute] = date('F d Y H:i:s', filemtime($pathName));
                                    break;
                                case 'inodeChangeAt': 
                                    $d[$attribute] = date('F d Y H:i:s', filectime($pathName));
                                    break;
                                case 'accessedAt': 
                                    $d[$attribute] = date('F d Y H:i:s', fileatime($pathName));
                                    break;    
                            }
                        }
                        $this->setOnlyData((object)$d);
                    }
                    break;
                default:
                    $d = [];
                    foreach ($this->usedAttributes as $attribute) {
                        switch ($attribute) {
                            case 'name': 
                                $d[$attribute] = basename($path);
                                break;
                            case 'basePath':
                                $d[$attribute] = $path;
                                break;
                            case 'subPath':
                                $d[$attribute] = './' . $this->subPath;
                                break;
                            case 'type':
                                $arr = explode('/', $type);
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
                    $this->setOnlyData((object)$d);
                    break;
            }
            return $this;
        } catch (Exception $e) {
            throw new Exception("Dir not found");
        }    
    }

    public function size(string $file = null, bool $status = false)
    {
        if ($status) {
            return ($file !== null) ? filesize($file) : filesize($this->basePath);
        }
        return ($file !== null) ? filesize($this->buildPath($file)) : filesize($this->basePath);
    }

    public function type(string $filePath)
    {
        try {
            $baseType = filetype($filePath);
            switch ($baseType) {
                case 'dir':
                    return $baseType;
                default :
                    $content = $this->read($filePath);
                    $f = finfo_open();
                    return finfo_buffer($f, $content, FILEINFO_MIME_TYPE);
            }
        } catch (Exception $e) {
            throw new Exception("Dir not found");
        }
    }

    public function create(string $fileName = null, bool $dir = true, int $mode = 0777, bool $recursive = false)
    {
        // dd($this);
        try {
            $file = $this->basePath . '/' . $this->subPath . '/' . $fileName;
            if ($dir == true) {
                return mkdir($file, $mode, $recursive);
            }
            return touch($file, time());
        } catch (Exception $e) {
            throw new Exception("Dir not found");
        }
    }


    public function read(string $filePath)
    {
        try {
            return file_get_contents($filePath, false);
        } catch(Exception $e) {
            throw new Exception("File not found");
        }
    }

    public function remove(string $fileName = null, $type = 'dir', $context = '')
    {
        $file = ($fileName !== null) ? $this->buildPath($fileName) : $this->basePath;
        $result = false;
        switch ($type) {
            case 'dir':
                if (is_dir($file)) {
                    $result = rmdir($file, $context);
                }
                break;
            case 'file':
                if (is_file($file)) {
                    $result = unlink($file, $context);
                }
                break;
        }

        return $result;
    }

    public function update()
    {

    }

    public function upload()
    {

    }

    public function download()
    {

    }
}