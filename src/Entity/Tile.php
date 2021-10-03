<?php

namespace App\Entity;

use App\Repository\TileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TileRepository::class)
 */
class Tile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
  /**
     * @var \App\Entity\TileType
     * @ORM\ManyToOne(targetEntity="App\Entity\TileType")
     */
    private $type;

    /**
     * @var \App\Entity\Monster
     * @ORM\ManyToOne(targetEntity="App\Entity\Monster")
     */
    private $monster;

    public function getId()
    {
        return $this->id;
    }

    public function getType() 
    {
        return $this->type;
    }

    public function setType( $type): self
    {
        $this->type = $type;

        return $this;
    }

   
    public function getMonster()
    {
        return $this->monster;
    }

    public function setMonster($monster): self
    {
        $this->monster = $monster;

        return $this;
    }
}
