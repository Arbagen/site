<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", unique=true)
     * @var string
     */
    protected $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     * @var Collection | Product[]
     */
    protected $products;
    
    /**
     * @ORM\OneToMany(targetEntity="ProductParam", mappedBy="category", orphanRemoval=true, fetch="EAGER", cascade={"persist", "remove"})
     * @var Collection | ProductParam[]
     */
    protected $productParams;
    
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
     * @return \App\Entity\Product[]|\Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
    
    /**
     * @param \App\Entity\Product[]|\Doctrine\Common\Collections\Collection $products
     */
    public function setProducts($products): void
    {
        $this->products = $products;
    }
    
    /**
     * @return array
     */
    public function getProductParams()
    {
        return $this->productParams;
    }
    
    /**
     * @param \App\Entity\ProductParam[]|\Doctrine\Common\Collections\Collection $productParams
     */
    public function setProductParams($productParams): void
    {
        $this->productParams = $productParams;
    }
}
