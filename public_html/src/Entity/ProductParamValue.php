<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductParamValueRepository")
 */
class ProductParamValue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="paramValues")
     */
    protected $product;
    
    /**
     * @ORM\ManyToOne(targetEntity="ProductParam", fetch="EAGER")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $productParam;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $productValue;
}
