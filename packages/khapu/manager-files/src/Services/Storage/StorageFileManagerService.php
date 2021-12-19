<?php
namespace Khapu\ManagerFiles\Services\Storage;

use Khapu\ManagerFiles\Services\Abs\FileManagerService;
use Khapu\ManagerFiles\Services\Storage\Proxy\StorageFileProxy as Storage;
use Exception;

class StorageFileManagerService extends FileManagerService
{
    public function __construct()
    {
        parent::__construct();
        $this->set('storage');
    }

    /**
     * @return StorageFileService
     */
    public function getFile()
    {
        $path = __DIR__ . "/../../../../../../{$this->url}";
        $file = new Storage($path, $this->getAllowMethod());
        return $file;
    }

    public function manageAction(string $action, array $params = [])
    {
        $file = $this->getFile();
        $allowMethod = $this->getAllowMethod() ?? [];
        if (!in_array($action, $allowMethod)) {
            $error = implode(', ', $allowMethod);
            throw new Exception("Action '{$action}' not allowed or not exist (Ex: {$error}) ");
        }
        return $file->{$action}($params);
    }

}   