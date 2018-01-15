<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ContactType")
     * @ORM\JoinColumn(name="type", referencedColumnName="id")
     */
    protected $type;
    
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $value;
    
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
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }
    
    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
    
    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
    
}
