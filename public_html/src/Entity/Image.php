<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", unique=true)
     * @var string
     */
    protected $path;
    
    /**
     * Image constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }
    
    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
    
    /**
     * @return integer
     */
    public function getId(): integer
    {
        return $this->id;
    }
    
    /**
     * @param integer $id
     */
    public function setId(integer $id): void
    {
        $this->id = $id;
    }
}
