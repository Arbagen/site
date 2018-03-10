<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\ManyToMany(targetEntity="Image", orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinTable(name="product_images", joinColumns={@ORM\JoinColumn(name="product", referencedColumnName="id", onDelete="CASCADE")})
     * @var Collection | Image[];
     */
    protected $images;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category", referencedColumnName="id", onDelete="SET NULL")
     *
     * @var Category
     */
    protected $category;
    
    /**
     * @ORM\OneToMany(targetEntity="ProductParamValue", mappedBy="product", orphanRemoval=true, fetch="EAGER")
     */
    protected $paramValues;
    
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
     * @return Collection|Image[]
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
    
    /**
     * @return \App\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * @param \App\Entity\Category $category
     */
    public function setCategory(\App\Entity\Category $category): void
    {
        $this->category = $category;
    }
    
    /**
     * @return mixed
     */
    public function getParamValues()
    {
        return $this->paramValues;
    }
    
    /**
     * @param mixed $paramValues
     */
    public function setParamValues($paramValues): void
    {
        $this->paramValues = $paramValues;
    }
    
}
