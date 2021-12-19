<?php
namespace Khapu\ManagerFiles\Http\Controllers;

use App\Http\Controllers\Controller;
use Khapu\ManagerFiles\Services\Storage\StorageFileManagerService as Storage;

class DashboardController extends Controller
{
    /**
     * @var Storage
     */
    public $_storage;
    public function __construct(Storage $storage)
    {
        $this->_storage = $storage;
    }
    public function index()
    {
        $folders = $this->_storage->getFile()->open()->dataValue;
        return view('khapu-filemanager::dashboard.index', ['folders' => $folders]);
    }
}