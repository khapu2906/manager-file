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

    public function open(string $subPath = '', bool $getContent = false)
    {   
        try{
            $subPath = ($subPath == '') ? '.' : $subPath;
            if ($this->basePath == '') {
                $this->setPath($subPath);
            } else {
                $this->setSubPath($subPath);
            }
            $path = $this->buildPath($subPath);
            // dd($subPath);
            // $path = ($subPath !== '') ? 
            //         $this->buildPath($subPath) :
            //         $this->basePath;
            $type = (filetype($path) == 'dir') ? filetype($path) : $this->type($path);
            switch ($type) {
                case 'dir': 
                    $listDir = scandir($path);
                    $this->count = count($listDir);
                    foreach ($listDir as $k => $v) {
                        $pathName = ($this->subPath !== '') ? 
                            $this->buildPath($this->subPath . '/' . $v) :
                            $this->buildPath($v);
                        $sizeConvert = $this->convertByteToOther($this->size($pathName, true));
                        $privateType = (filetype($pathName) == 'dir') ? filetype($pathName) : $this->type($pathName);
                        $arr = explode('/', $privateType);
                        $typeArr['synthetic'] = $arr[0];                            
                        $typeArr['detail'] = data_get($arr, '1', $arr[0]);                            
                        $d = (object)[
                            'name'          => basename($v),
                            'basePath'      => $pathName,
                            'subPath'       => $this->subPath . "/" . $v,
                            'type'          => (object)$typeArr,
                            'content'       => 'undefined',
                            'size'          => $sizeConvert['value'],
                            'unitSize'      => $sizeConvert['unit'],
                            'permission'    => fileperms($pathName),
                            'modifiedAt'    => date('F d Y H:i:s', filemtime($pathName)),
                            'inodeChangeAt' => date('F d Y H:i:s', filectime($pathName)),
                            'accessedAt'    => date('F d Y H:i:s', fileatime($pathName))
                        ];
                        $this->setOnlyData($d);
                    }
                    break;
                default:
                    $sizeConvert = $this->convertByteToOther($this->size($path, true));
                    $arr = explode('/', $type);
                        $typeArr['synthetic'] = $arr[0];                            
                        $typeArr['detail'] = data_get($arr, '1', $arr[0]);     
                    $file = (object)[
                        'name'          => basename($path),
                        'basePath'      => $path,
                        'subPath'       => './' . $this->subPath,
                        'type'          => (object)$typeArr,
                        'content'       => ($getContent) ? $this->read($path) : 'undefined',
                        'size'          => $sizeConvert['value'],
                        'unitSize'      => $sizeConvert['unit'],
                        'permission'    => fileperms($path),
                        'modifiedAt'    => date('F d Y H:i:s', filemtime($path)),
                        'inodeChangeAt' => date('F d Y H:i:s', filectime($path)),
                        'accessedAt'    => date('F d Y H:i:s', fileatime($path))
                    ];
                    // dd($this);
                    $this->setOnlyData($file);
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

    public function create(string $fileName = null, $type = 'dir', int $mode = 0777, bool $recursive = false)
    {
        $file = ($fileName !== null) ? $this->buildPath($fileName) : $this->basePath;
        $result = false;
        switch ($type) {
            case 'dir':
                $result = mkdir($file, $mode, $recursive);
                break;
            case 'file':
                $result = touch($file, time());
                break;
        }

        return $result;
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