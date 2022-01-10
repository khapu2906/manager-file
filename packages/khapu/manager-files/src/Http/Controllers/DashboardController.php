<?php

namespace Khapu\ManagerFiles\Http\Controllers;

use Khapu\ManagerFiles\Http\Controllers\BaseController;

class DashboardController extends BaseController
{

    public function index($fileName = '')
    {
        $folderInfo = $this->_storage->open($fileName);
        $this->setMenuFolder($folderInfo);
        $folders = $folderInfo->get();
        return view('khapu-filemanager::dashboard.index', ['folders' => $folders]);
    }

    public function create($fileName)
    {
        // dd($fileName);
        $file = $this->_storage->open($fileName);
        dd($file);
    }
}
