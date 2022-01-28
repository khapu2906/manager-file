<?php

namespace Khapu\Directory\Traits\Events;
use Exception;

trait RemoveEvent
{
    
    public function remove($context = null)
    {
        try{
            $this->handler($this->fullPath);
            return false;
        } catch (Exception $e) {
            throw new Exception("Dir not found !");
        }
    }

    private function handler(string $file) {
        try{
            $type = filetype($file); 
            switch ($type) {
                case 'dir':
                    $dirs = scandir($file);
                    if (count($dirs) > 2) {
                        foreach ($dirs as $dir) {
                            switch ($dir) {
                                case '.':
                                case '..':
                                    break;
                                default:
                                    $dir = $file . '/' . $dir;
                                    $this->handler($dir);
                                break;
                            }
                        }
                    }
                    return rmdir($file);
                case 'file':
                    return unlink($file);
            }
        } catch (Exception $e) {
            throw new Exception("Dir not found !");
        }
    }

}
