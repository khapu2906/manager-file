<?php

namespace Khapu\Directory\Traits\Events;
use Exception;

trait RenameEvent
{
    private function _ruler(string $nameFile, $type)
    {
        switch ($type) {
            case 'dir':
                if (preg_match("/^[^\/:*?<>|.\" ]{1,}+$/", $nameFile) <= 0) {
                    throw new Exception("Format dirname is ^[^\/:*?<>|.\" ]{1,}$");
                }
                break;
            default:
                if (preg_match("/^[^\/:*?<>|\" ]{1,}+$/", $nameFile) <= 0) {
                    throw new Exception("Format filename is ^[^\/:*?<>|\" ]{1,}$");
                }
                break;
        }
    }
    
    public function rename(string $newName)
    {
        $file = $this->basePath . '/' . $this->subPath;
        try {
            $type = filetype($file);
        } catch (Exception $e) {
            throw new Exception("Dir not found");
        }
        $this->_ruler($newName, $type);

        $newFileArr = explode( '/', $this->subPath);
        unset($newFileArr[count($newFileArr) - 1]);
        $newPath = $this->basePath . '/' . implode('/', $newFileArr) . '/' . $newName;
        return rename($file, $newPath);
    }

}
