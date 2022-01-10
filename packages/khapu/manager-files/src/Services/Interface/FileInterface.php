<?php

namespace Khapu\ManagerFiles\Services\Itf;

interface FileInterface 
{
    /**
     * @return FileInterface 
     */
    public static function getInstance(string $path, array $allowMethod);

    public function open(string $filePath = '', array $attributes = [], bool $getContent = false);
    
    /**
     * @param string $fileName
     *  @param boolean $status - status is false that mean param file is sub-path, else param is full-path
     * 
     * @return string
     */
    public function read(string $fileName, bool $status = false);

    public function create();

    public function update();

    public function upload();

    public function download();

}