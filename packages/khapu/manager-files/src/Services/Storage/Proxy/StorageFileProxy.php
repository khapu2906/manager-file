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


    public function open(string $filePath = '', bool $getContent = false)
    {
        return $this->_storage->open($filePath, $getContent);
    }

    public function read($fileName, $status = false)
    {
        return $this->_storage->read($fileName, $status);
    }

    public function create()
    {
        return $this->_storage->create();
    }

    public function update()
    {
        return $this->_storage->update();
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