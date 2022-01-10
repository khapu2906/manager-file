<?php

namespace Khapu\ManagerFiles\Http\Controllers;

use App\Http\Controllers\Controller;
use Khapu\ManagerFiles\Services\Storage\StorageFileManagerService as Storage;
use Khapu\Directory\Services\DirectoryService as Directory;

class BaseController extends Controller
{
    /**
     * @var Storage
     */
    public $_storage;

    public $_menuFolders = [];

    public function __construct(Storage $storage)
    {
        $this->_storage = $storage->getFile();
    }

    protected function setMenuFolder(Directory $directoryService)
    {   
        $folders = $directoryService->get();
        if (!empty($folders)) {
            foreach ($folders as $folder) {
                switch ($folder->type->synthetic) {
                    case 'dir':
                        array_push($this->_menuFolders, $folder);
                        break;
                }
            }
        }
    }
}
