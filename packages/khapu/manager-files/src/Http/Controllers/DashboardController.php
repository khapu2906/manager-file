<?php

namespace Khapu\ManagerFiles\Http\Controllers;

use Khapu\ManagerFiles\Http\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends BaseController
{

    public function index($fileName = '.')
    {
        $folderInfo = $this->_storage->open($fileName);
        $this->setMenuFolder($folderInfo);
        $folders = $folderInfo->get();
        return view('khapu-filemanager::dashboard.index', 
            [
                'folders' => $folders,
                'menuFolders' => $this->_menuFolders
        ]);
    }

    public function create(Request $request)
    {
        $this->_storage->create('test', 'test', false);
        // dd($fileName);
        // $file = $this->_storage->open($fileName);
        // dd($file);
    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }
}
