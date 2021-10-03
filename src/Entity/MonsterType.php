<?php

namespace App\Entity;

use App\Repository\MonsterTypeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MonsterTypeRepository::class)
 */
class MonsterType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $life;

   /**
     * @ORM\Column(type="integer")
     */
    private $nbDice;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbFace;
   
    /**
     * @ORM\Column(type="integer")
     */
    private $malus;

    /**
     * @ORM\Column(type="integer")
     */
    private $armor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLife(): ?int
    {
        return $this->life;
    }

    public function setLife(int $life): self
    {
        $this->life = $life;

        return $this;
    }

    public function getArmor(): ?int
    {
        return $this->armor;
    }

    public function setArmor(int $armor): self
    {
        $this->armor = $armor;

        return $this;
    }

    /**
     * Get the value of nbDice
     */ 
    public function getNbDice()
    {
        return $this->nbDice;
    }

    /**
     * Set the value of nbDice
     *
     * @return  self
     */ 
    public function setNbDice($nbDice)
    {
        $this->nbDice = $nbDice;

        return $this;
    }

    /**
     * Get the value of nbFace
     */ 
    public function getNbFace()
    {
        return $this->nbFace;
    }

    /**
     * Set the value of nbFace
     *
     * @return  self
     */ 
    public function setNbFace($nbFace)
    {
        $this->nbFace = $nbFace;

        return $this;
    }

    /**
     * Get the value of malus
     */ 
    public function getMalus()
    {
        return $this->malus;
    }

    /**
     * Set the value of malus
     *
     * @return  self
     */ 
    public function setMalus($malus)
    {
        $this->malus = $malus;

        return $this;
    }
}
