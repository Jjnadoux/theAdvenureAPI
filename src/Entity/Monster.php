<?php

namespace App\Entity;

use App\Entity\MonsterType;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MonsterRepository;

/**
 * @ORM\Entity(repositoryClass=MonsterRepository::class)
 */
class Monster
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

  
    /**
     * @var \App\Entity\MonsterType
     * @ORM\ManytoOne(targetEntity="App\Entity\MonsterType")
        */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $life;

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type): self
    {
        $this->type = $type;

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
}
