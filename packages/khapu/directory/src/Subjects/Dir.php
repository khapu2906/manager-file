<?php

namespace Khapu\Directory\Subjects;

abstract class Dir
{
    /**
     * @var string $basePath - the path of base dir 
     */
    var $basePath;

    /**
     * @var string $fullPath = the 
     */
    var $fullPath;

    /**
     * @var string $subPath - the sub-path of dir
     */
    var $subPath;

    /**
     * @var string $name
     */
    var $name;

    /**
     * @var object $listType - the list of file data types
     */
    var $type;

    /**
     * @var float $size
     */
    var $size;

    /**
     * @var string $unitSize
     */
    var $unitSize;

    /**
     * @var string $content
     */
    var $content;

    /**
     * @var string $permission
     */
    var $permission;

    /**
     * @var string $modifiedAt
     */
    var string $modifiedAt;

    /**
     * @var string $inodeChangeAt
     */
    var $inodeChangeAt;

    /**
     * @var string $accessedAt
     */
    var $accessedAt;

    /**
     * @param string $path 
     */
}