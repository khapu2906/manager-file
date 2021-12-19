<?php

namespace Khapu\ManagerFiles\Services\Abs;

use Khapu\ManagerFiles\Services\Itf\FileInterface as File;

abstract class FileManagerService
{
    /**
     * @var config 
     */
    public $config = [];

    /**
     * @var childConfig
     */
    public $childConfig = [];

    /**
     * @var url
     */
    public $url = '';

    /**
     * @var olderName
     */
    public $folderName = '';

    /**
     * @var useAuth
     */
    public $useAuth = false;

    /**
     * @var action
     */
    public $action = [];

    /**
     * @var maxMemoryCapacity
     */
    public $maxMemoryCapacity = 512000;

    /**
     * @var settingFile
     */
    public $settingFile = [];

    /**
     * @var allowFile
     */
    public $allowFile = [];

    /**
     * @var allowMethod 
     */
    public $allowMethod = [];

    public function __construct()
    {
        if (config('khapufile')) {
            $this->config = config('khapufile');
        } else {
            if (is_file("../config/khapufile.php")) {
                $this->config = require_once("../config/khapufile.php");
            }
        }
    }

    /**
     * @return File
     */
    abstract protected function getFile();

    public function set(string $key)
    {
        $this->setChildConfig($key);
        $this->setFolderName();
        $this->setUrl();
        $this->setMaxMemoryCapacity();
        $this->setUserAuth();
        $this->setAction();
        $this->setSettingFile();
        $this->setAllowFile();
    }

    public function setChildConfig(string $key)
    {
        $this->childConfig = data_get($this->config, $key);
    }

    public function setFolderName()
    {
        $this->folderName = data_get($this->childConfig, 'folder_name');
    }

    public function setUrl()
    {
        $this->url = data_get($this->childConfig, 'url');
    }

    public function setAction()
    {
        $this->action = data_get($this->childConfig, 'action');
    }

    public function setSettingFile()
    {
        $this->settingFile = data_get($this->childConfig, 'setting_file');
    }

    public function setAllowFile()
    {
        if (!empty($this->settingFile)) {
            foreach ($this->settingFile as $item) {
                $this->allowFile = array_merge_recursive($this->allowFile, data_get($item, 'end'));
            }
        }
    }

    public function setMaxMemoryCapacity()
    {
        $this->maxMemoryCapacity = data_get($this->childConfig, 'max_memory_capacity');
    }

    public function setUserAuth()
    {
        $this->userAuth = data_get($this->childConfig, 'use_auth');
    }

    public function getAllowMethod()
    {
        if (!empty($this->action)) {
            $this->allowMethod = array_keys($this->action, true);
        }
        return $this->allowMethod;
    }

    public function getAllowFile() 
    {
        return $this->allowFile;
    }

    public function getConfig() 
    {
        return $this->config;
    }

    public function getChildConfig()
    {
        return $this->childConfig;
    }

}