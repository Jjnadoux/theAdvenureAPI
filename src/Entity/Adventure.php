<?php

namespace App\Entity;

use App\Repository\AdventureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdventureRepository::class)
 */
class Adventure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

   /**
     * @var \App\Entity\Tile
     * @ORM\ManyToOne(targetEntity="App\Entity\Tile")
     */
    private $tile;

    /**
     * @var \App\Entity\Character
     * @ORM\OneToOne(targetEntity="App\Entity\Character")
     */
    private $character;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbTile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTile() 
    {
        return $this->tile;
    }

    public function setTile($tile): self
    {
        $this->tile = $tile;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get the value of character
     */ 
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * Set the value of character
     *
     * @return  self
     */ 
    public function setCharacter($character)
    {
        $this->character = $character;

        return $this;
    }

    /**
     * Get the value of nbTile
     */ 
    public function getNbTile()
    {
        return $this->nbTile;
    }

    /**
     * Set the value of nbTile
     *
     * @return  self
     */ 
    public function setNbTile($nbTile)
    {
        $this->nbTile = $nbTile;

        return $this;
    }
}
