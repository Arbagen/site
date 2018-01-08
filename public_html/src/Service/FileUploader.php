<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;
    
    /**
     * FileUploader constructor.
     *
     * @param $targetDir
     */
    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }
    
    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    public function upload(UploadedFile $file)
    {
        if (!$file->isValid()) {
            return null;
        }
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $filePath = $this->getTargetDir() . $fileName;
        
        $file->move($this->getTargetDir(), $fileName);
        
        return $filePath;
    }
    
    public function getTargetDir()
    {
        return $this->targetDir;
    }
}