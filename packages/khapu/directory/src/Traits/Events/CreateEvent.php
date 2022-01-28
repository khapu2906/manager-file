<?php

namespace Khapu\Directory\Traits\Events;
use Exception;

trait CreateEvent
{
    
    public function create(string $fileName = null, bool $dir = true, int $mode = 0777, bool $recursive = false)
    {
        try {
            $file = $this->basePath . '/' . $this->subPath . '/' . $fileName;
            if ($dir == true) {
                return mkdir($file, $mode, $recursive);
            }
            return touch($file, time());
        } catch (Exception $e) {
            throw new Exception("Dir not found");
        }
    }

}
