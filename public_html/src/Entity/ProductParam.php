<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductParamRepository")
 */
class ProductParam
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="productParams")
     * @ORM\JoinColumn(name="category", referencedColumnName="id")
     *
     * @var Category
     */
    protected $category;
    
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    
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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
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
    public function setCategory($category): void
    {
        $this->category = $category;
    }
    
}
