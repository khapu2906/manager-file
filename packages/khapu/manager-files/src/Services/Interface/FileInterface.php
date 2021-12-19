<?php

namespace Khapu\ManagerFiles\Services\Itf;

interface FileInterface 
{
    /**
     * @return FileInterface 
     */
    // public static function getInstance();

    public function open();

    public function read();

    public function create();

    public function update();

    public function upload();

    public function download();

}