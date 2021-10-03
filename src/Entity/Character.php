<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 * @ORM\Table(name="`character`")
 */
class Character
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
     *@ORM\Column(type="integer")
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
}
