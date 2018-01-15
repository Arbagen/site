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
    protected $publicDir;
    
    /**
     * FileRemover constructor.
     *
     * @param string $publicDir
     */
    public function __construct(string $publicDir)
    {
        $this->publicDir = $publicDir;
    }
    
    /**
     * @param string $pathToFile
     */
    public function removeFile(string $pathToFile)
    {
        if (file_exists($this->publicDir . $pathToFile)) {
            unlink($this->publicDir . $pathToFile);
        }
    }
}