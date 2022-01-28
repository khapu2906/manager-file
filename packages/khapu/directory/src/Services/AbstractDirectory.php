<?php

namespace Khapu\Directory\Services;
use Khapu\Directory\Traits\Queries\Query;
use Exception;

abstract class AbstractDirectory
{
    use Query;

    const LOGICS = ['and', 'or', 'exc'];

    const OPERATORS = ['>', '<', '=', '<=', '>='];
    /**
     * @var string $basePath - the path of base dir 
     */
    public $basePath = '.';

    /**
     * @var string $fullPath = the 
     */
    public $fullPath = '.';

    /**
     * @var string $subPath - the sub-path of dir
     */
    public $subPath = '';

    /**
     * @var object $listType - the list of file data types
     */

    protected $type;

    /**
     * @var array $attributes - the attributes of a directory
     */
    protected $attributes = [
       
    ];

    /**
     * @var array $afterAttributes - the attributes are used
     */
    protected $usedAttributes = [];

    /**
     * @var array $dataValue - the data value is list of file in this directory
     */
    protected $dataValue = [];

    /**
     * @var array $where - 
     */
    protected $where = [];

    /**
     * @var int $limit
     */
    protected $limit = 0;

    /**
     * @var int $offset
     */
    protected $offset = 0;

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
        $this->setFullPath($path);
        $this->attributes = array_keys(get_class_vars('Khapu\Directory\Subjects\Dir'));
        $this->usedAttributes = $this->attributes;
    }

    /**
     * @param string $path
     * @return AbstractDirectory
     */

    public function come(string $path)
    {
        $this->fullPath .= ($path !== '') ? '/' . $path: '';
        $this->setSubPath($path);
        return $this;
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
    public function setFullPath(string $path)
    {
        $this->fullPath = $path;
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
    public function getFullPath()
    {
        return $this->fullPath;
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

    /**
     * @return array $dataValue -- get the first element of dataValue
     */
    public function first()
    {
        return current($this->dataValue);
    }

    public function need(array $attributes)
    {
        $newArr = [];
        foreach ($attributes as $attribute) {
            if (in_array($attribute, $this->attributes)) {
                array_push($newArr, $attribute);
            } else {
                throw new Exception("Attribute not found! ");
            }
        }
        $this->usedAttributes = $newArr;
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