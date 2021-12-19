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

    public function getInsideDir(string $subPath = '', $type = 'dir')
    {   
        $listDir = [];
        try{
            if ($subPath == '') {
                $listDir = scandir($this->basePath);
            } else {
                if ('dir' === $type) {
                    $this->setSubPath($subPath);
                    $listDir = scandir($this->buildPath($this->subPath));
                } else {
                    $listDir = glob($subPath);
                }
            }  

            foreach ($listDir as $k => $v) {
                $pathName = ($this->subPath !== '') ? 
                    $this->buildPath($this->subPath . '/' .$v) :
                    $this->buildPath($v);
                $sizeConvert = $this->convertByteToOther($this->checkSize($pathName, true));
                $d = (object)[
                    'name' => $v,
                    'url' =>  $pathName,
                    'type' => (filetype($pathName) == 'dir') ? filetype($pathName) : $this->checkType($v),
                    'size' => $sizeConvert['value'],
                    'unitSize' => $sizeConvert['unit'],
                    'permission' => fileperms($pathName),
                    'modifiedAt' => date('F d Y H:i:s', filemtime($pathName)),
                    'inodeChangeAt' => date('F d Y H:i:s', filectime($pathName)),
                    'accessedAt' => date('F d Y H:i:s', fileatime($pathName))
                ];
                $this->setOnlyData($d);
            }
            return $this;
        } catch (Exception $e) {
            throw new Exception("Dir not found");
        }    
    }

    public function checkSize(string $file = null, bool $status = false)
    {
        if ($status) {
            return ($file !== null) ? filesize($file) : filesize($this->basePath);
        }
        return ($file !== null) ? filesize($this->buildPath($file)) : filesize($this->basePath);
    }

    public function checkType(string $fileName)
    {
        $arr = explode('.', $fileName);
        $extension = end($arr);
        if (array_key_exists($extension, (array)$this->listType)) {
            return $this->listType->{$extension};
        }
        return '';
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


    public function read(string $fileName = null)
    {
        $file = ($fileName !== null) ? $this->buildPath($fileName) : $this->basePath;
        file_get_contents($file, $use_includebasePath = FALSE, $offset = 0);
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