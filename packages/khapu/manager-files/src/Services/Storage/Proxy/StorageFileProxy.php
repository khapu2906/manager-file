<?php
namespace Khapu\ManagerFiles\Services\Storage\Proxy;

use Khapu\ManagerFiles\Services\Storage\StorageFileService as Storage;
use Khapu\ManagerFiles\Services\Itf\FileInterface;

class StorageFileProxy implements FileInterface
{
    private $_storage;

    private static $_instance;

    public function __construct($path, $allowMethod)
    {
        $this->_storage = Storage::getInstance($path, $allowMethod);
    }

    public static function getInstance($path, $allowMethod) {
        if (null == self::$_instance) {
            self::$_instance = new self($path, $allowMethod);
        }
        return self::$_instance;
    }


    public function open(string $filePath = '', array $attributes = [], bool $getContent = false)
    {
        return $this->_storage->open($filePath, $attributes, $getContent);
    }

    public function read($fileName, $status = false)
    {
        return $this->_storage->read($fileName, $status);
    }

    public function create(string $filePath, string $fileName, bool $dir)
    {
        return $this->_storage->create($filePath, $fileName, $dir);
    }

    public function update()
    {
        return $this->_storage->update();
    }

    public function delete(string $filePath)
    {
        return $this->_storage->delete($filePath);
    }

    public function rename(string $filePath, string $fileName)
    {
        return $this->_storage->rename($filePath, $fileName);
    }

    public function upload()
    {
        return $this->_storage->upload();
    }

    public function download()
    {
        return $this->_storage->download();
    }
}