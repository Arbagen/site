<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Image;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var integer
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $name;
    
    /**
     * @ORM\Column(type="decimal")
     * @var float
     */
    protected $price;
    
    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $description;
    
    /**
     * @ORM\ManyToMany(targetEntity="Image", orphanRemoval=true)
     * @ORM\JoinTable(name="product_images", joinColumns={@ORM\JoinColumn(name="product", referencedColumnName="id", onDelete="CASCADE")})
     * @var ArrayCollection | Image[];
     */
    protected $images;
    
    /**
     * @var UploadedFile[]
     */
    protected $imagesToUpload = [];
    
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }
    
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    /**
     * @return ArrayCollection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }
    
    /**
     * @param Image $image
     */
    public function addImage(Image $image): void
    {
        $this->images->add($image);
    }
    
    /**
     * @param \App\Entity\Image $image
     */
    public function removeImage(Image $image): void
    {
        $this->images->removeElement($image);
    }
    
    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
    
    /**
     * @param array $imagesToUpload
     */
    public function setImagesToUpload(array $imagesToUpload): void
    {
        $this->imagesToUpload = $imagesToUpload;
    }
    
    /**
     * @return array
     */
    public function getImagesToUpload(): array
    {
        return $this->imagesToUpload;
    }
    
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    
    
}
