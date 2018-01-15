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
     * @ORM\JoinColumn(name="type", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $type;
    
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $value;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $owner;
    
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $position;
    
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
    public function getValue()
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
    
    /**
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * @param string $owner
     */
    public function setOwner(string $owner): void
    {
        $this->owner = $owner;
    }
    
    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }
    
    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }
    
}
