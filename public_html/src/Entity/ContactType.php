<?php

namespace App\Entity;

use App\Entity\Image;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactTypeRepository")
 */
class ContactType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    protected $name;
    
    /**
     * @var \App\Entity\Image
     * @ORM\OneToOne(targetEntity="Image", orphanRemoval=true)
     * @ORM\JoinColumn(name="image", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $logo;
    
    /**
     * @var UploadedFile
     */
    protected $uploadedFile = null;
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
    /**
     * @return \App\Entity\Image
     */
    public function getLogo()
    {
        return $this->logo;
    }
    
    /**
     * @param \App\Entity\Image $logo
     */
    public function setLogo(\App\Entity\Image $logo): void
    {
        $this->logo = $logo;
    }
    
    /**
     * @return \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public function getUploadedFile()
    {
        return $this->uploadedFile;
    }
    
    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $uploadedFile
     */
    public function setUploadedFile(UploadedFile $uploadedFile): void
    {
        $this->uploadedFile = $uploadedFile;
    }
    
    
}
