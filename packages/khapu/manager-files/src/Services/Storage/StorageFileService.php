<?php
namespace Khapu\ManagerFiles\Services\Storage;

use Khapu\ManagerFiles\Services\FileInterface;
use Khapu\Directory\Services\DirectoryService;
use Exception;

class StorageFileService
{
    protected $_directoryService;

    private $_allowMethod = [];

    private static $_instance;

    public function __construct($path, $allowMethod)
    {
        $this->_directoryService = new DirectoryService($path);
        $this->_allowMethod = $allowMethod;
    }

    public static function getInstance($path, $allowMethod)
    {
        if (null == self::$_instance) {
            self::$_instance = new self($path, $allowMethod);
        }
        return self::$_instance;
    }

    private function open(string $filePath, array $attributes = [], bool $getContent = false)
    {
        
        $folders = $this->_directoryService->come($filePath);
        if (!empty($attributes)) {
            $attributes = array_merge_recursive($attributes, ['name', 'type']);
            $folders->need($attributes);
        }

        $folders->open($getContent);
        $oldData = $folders->get();
        $newData = [];
        foreach ($oldData as $element) {
            switch ($element->type->synthetic) {
                case 'dir':
                    if (strpos($element->name, '.') === false) {
                        array_push($newData, $element);
                    }
                    break;
                default:
                    array_push($newData, $element);
                    break;
            }
        }

        $folders->count = count($newData); 
        $folders->setData($newData);

        return $folders;

    }

    /**
     * @param string $fileName
     *  @param boolean $status - status is false that mean param file is sub-path, else param is full-path
     * 
     * @return string
     */
    private function read(string $fileName, bool $status = false)
    {
        return $this->_directoryService->read($fileName, $status);
    }


    private function create(string $filePath, string $fileName, bool $dir)
    {
        return $this->_directoryService->come($filePath)->create($fileName, $dir);
    }

    private function update()
    {
        return $this->_directoryService->update();
    }


    private function delete(string $filePath)
    {
        return $this->_directoryService->come($filePath)->remove($filePath);
    }

    private function rename(string $filePath, string $newName)
    {
        return $this->_directoryService->come($filePath)->rename($newName);
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
