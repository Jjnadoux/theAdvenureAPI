<?php

namespace App\Entity;

use App\Repository\TileTypeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TileTypeRepository::class)
 */
class TileType
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
    private $bonus;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $monsterAffect;

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

   
    /**
     * Get })
     */ 
    public function getMonsterAffect()
    {
        return $this->monsterAffect;
    }

    /**
     * Set })
     *
     * @return  self
     */ 
    public function setMonsterAffect($monsterAffect)
    {
        $this->monsterAffect = $monsterAffect;

        return $this;
    }

    /**
     * Get the value of bonus
     */ 
    public function getBonus()
    {
        return $this->bonus;
    }

    /**
     * Set the value of bonus
     *
     * @return  self
     */ 
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;

        return $this;
    }
}
