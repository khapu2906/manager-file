<?php

namespace Khapu\Directory\Services;
use Exception;

abstract class AbstractDirectory
{
    /**
     * @var string $path - the path of dir or file 
     */
    public $basePath = '';

    /**
     * @var string $subPath - the sub-path of dir
     */
    public $subPath = '';

    /**
     * @var object $listType - the list of file data types
     */

    protected $type;

    /**
     * @var array $attributes - the attribute of a directory
     */
    public $attributes = [
        'name',
        'basePath',
        'subPath',
        'type',
        'size',
        'content',
        'unitSize',
        'permission',
        'modified_at',
        'inode_change_at',
        'accessed_at'
    ];

    /**
     * @var array $dataValue - the data value is list of file in this directory
     */
    protected $dataValue = [];

    /**
     * @var int $count - the number of files in folder
     */
    public $count = 0;

    /**
     * @param string $path 
     */
    public function __construct(string $path = '')
    {
        $this->setPath($path);
    }

    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->basePath = $path;
    }

     /**
     * @param string $path
     */
    public function setSubPath(string $path)
    {
        $this->subPath = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->basePath;
    }

    /**
     * @return string
     */
    public function getSubPath()
    {
        return $this->subPath;
    }

    /**
     * @param string $pathName - is a sub-path
     */
    public function buildPath(string $pathName = '')
    {
        return $this->basePath . '/' . $pathName;
    }

    /**
     * @param object $data
     * 
     */
    public function setOnlyData(object $data)
    {
        array_push($this->dataValue, $data);
    }

    /**
     * @param array $data
     * 
     */
    public function setData(array $data)
    {
        $this->dataValue = $data;
    }

    /**
     * @return array $dataValue;
     */

    public function get()
    {
        return $this->dataValue;
    }

    public function first()
    {
        return current($this->dataValue);
    }

    /**
     * @param string 
     */
    public function __get(string $var)
    {
        if (property_exists($this, $var)) {
           return $this->{$var};
        }
    }

}