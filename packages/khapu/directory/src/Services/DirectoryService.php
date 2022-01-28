<?php

namespace Khapu\Directory\Services;

use Khapu\Directory\Services\AbstractDirectory;
use Khapu\Directory\Services\InterfaceDirectory;
use Khapu\Directory\Traits\ConvertData;
use Khapu\Directory\Traits\Events\OpenEvent;
use Khapu\Directory\Traits\Events\CreateEvent;
use Khapu\Directory\Traits\Events\RemoveEvent;
use Khapu\Directory\Traits\Events\UpdateEvent;
use Khapu\Directory\Traits\Events\UploadEvent;
use Khapu\Directory\Traits\Events\DownloadEvent;
use Khapu\Directory\Traits\Events\MoveEvent;
use Khapu\Directory\Traits\Events\RenameEvent;
use Exception;

final class DirectoryService extends AbstractDirectory implements InterfaceDirectory
{
    use ConvertData, OpenEvent, CreateEvent, RemoveEvent, UpdateEvent, 
        UploadEvent, DownloadEvent, MoveEvent, RenameEvent;

    public function dir()
    {
        $dir = dir($this->basePath);
        return $dir;
    }

    public function sort()
    {
        return $this;

    }

    public function limit()
    {
        return $this;

    }

    public function offset()
    {
        return $this;
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

    public function read(string $filePath)
    {
        try {
            return file_get_contents($filePath, false);
        } catch(Exception $e) {
            throw new Exception("File not found");
        }
    }
}