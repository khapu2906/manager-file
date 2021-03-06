<?php

namespace Khapu\Directory\Services;

interface InterfaceDirectory
{
    /**
     * @return directory
     */
    public function dir();

    /**
     * @param string $subPath - use for touching more deeply to sub path
     * 
     * @return array
     */
    public function open(bool $getContent = false);

    /**
     * @param string $file    - use to check size of file, default value is null, function with hanlde
     *                        with global value 
     * @param boolean $status - status is false that mean param file is sub-path, else param is full-path
     * 
     * @return int - size in Byte
     */
    public function size(string $file = null, bool $status = false);

    /**
     * @param string $filePath
     */
    public function type(string $filePath);
    /**
     * @param string $fileName 
     * @param string $dir 
     * @param int $mode
     * @param bool $recursive
     * 
     * @return boolean
     */
    public function create(string $fileName = null, bool $dir = true, int $mode = 0777, bool $recursive = false);

    /**
     * @param string $filePath
     */

    public function read(string $filePath);

    /**
     * @param string $fileName 
     * @param string $type 
     * @param string $context
     * 
     * @return boolean
     */

    public function remove($context = null);

    /**
     * @param string $newName;
     */
    public function rename(string $newName);
    
    public function update();

    public function upload();

    public function download();
}