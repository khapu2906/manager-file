<?php
namespace Khapu\ManagerFiles\Services\Storage\Proxy;

use Khapu\ManagerFiles\Services\Storage\StorageFileService as Storage;
use Khapu\ManagerFiles\Services\Itf\FileInterface;

class StorageFileProxy implements FileInterface
{
    private $_storage;

    public function __construct($path, $allowMethod)
    {
        $this->_storage = new Storage($path, $allowMethod);
    }

    public function open()
    {
        return $this->_storage->open();
    }

    public function read()
    {
        return $this->_storage->read();
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