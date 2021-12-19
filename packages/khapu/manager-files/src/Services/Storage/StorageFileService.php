<?php
namespace Khapu\ManagerFiles\Services\Storage;

use Khapu\ManagerFiles\Services\FileInterface;
use Khapu\Directory\Services\DirectoryService;
use Exception;

class StorageFileService
{
    protected $_directoryService;

    private $_allowMethod = [];

    public function __construct($path, $allowMethod)
    {
        $this->_directoryService = new DirectoryService($path);
        $this->_allowMethod = $allowMethod;
    }

    private function open()
    {
        
        $folders = $this->_directoryService->getInsideDir();
        $oldData = $folders->get();
        $newData = array_splice($oldData, 2);
        $folders->setData($newData);

        return $folders;

    }

    private function read()
    {
        return $this->_directoryService->read();
    }

    private function create()
    {
        return $this->_directoryService->create();
    }

    private function update()
    {
        return $this->_directoryService->update();
    }

    private function remover()
    {
        return $this->_directoryService->remove();
    }

    private function upload()
    {
        return $this->_directoryService->upload();
    }

    private function download()
    {
        return $this->_directoryService->download();
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            if (!in_array($method, $this->_allowMethod)) {
                $error = implode(', ', $this->_allowMethod);
                throw new Exception("Action '{$method}' not allowed or not exist (Ex: {$error}) ");
            }
            return call_user_func_array([$this, $method], $arguments);
        }
    }

}
