<?php

namespace Khapu\ManagerFiles\Http\Controllers;

use Khapu\ManagerFiles\Http\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Khapu\Directory\Services\DirectoryService as KhapuFile;
class DashboardController extends BaseController
{

    public function index($fileName = '')
    {
        $folderInfo = $this->_storage->open($fileName);
        $this->setMenuFolder($folderInfo);
        $subPath = $folderInfo->getSubPath();
        $folders = $folderInfo->get();
        return view('khapu-filemanager::dashboard.index', 
            [
                'folders' => $folders,
                'subPath' => $subPath,
                'menuFolders' => $this->_menuFolders
        ]);
    }

    public function create(Request $request)
    {
        $create = $this->_storage->create('test', 'hallo', true);
        // dd($fileName);
        // $file = $this->_storage->open($fileName);
        // dd($file);
    }

    public function update(Request $request)
    {

    }

    public function delete($filePath)
    {
        $delete = $this->_storage->delete($filePath);
    }

    public function rename($filePath, $fileName)
    {
        $rename = $this->_storage->rename($filePath, $fileName);
    }

    public function test()
    {   
        $condition = [
            [
                'name' => [
                    '=' => 'N3GFVXOZBQPOPD0MFSIM - Copy - Copy - Copy - Copy - Copy - Copy.png',
                ],
                'size' => [
                    '<=' => 860,
                    '>' => 16,
                ]
            ],
        ];
        $khapu = new KhapuFile('./khapu-filemanager');
        $khapu = $khapu->come('storage');
        $khapu = $khapu->where($condition);                                                                                                                                                                                                                                                                                                                  
        $khapu = $khapu->open();
        dd($khapu);
    }
}
