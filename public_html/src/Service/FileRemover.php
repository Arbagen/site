<?php

namespace App\Service;


/**
 * Class FileRemover
 *
 * @package App\Service
 */
class FileRemover
{
    
    /**
     * @var string
     */
    protected $baseDir;
    
    /**
     * FileRemover constructor.
     *
     * @param string $baseDir
     */
    public function __construct(string $baseDir)
    {
        $this->baseDir = $baseDir;
    }
    
    /**
     * @param string $pathToFile
     */
    public function removeFile(string $pathToFile)
    {
        if (file_exists($this->baseDir . $pathToFile)) {
            unlink($this->baseDir . $pathToFile);
        }
    }
}