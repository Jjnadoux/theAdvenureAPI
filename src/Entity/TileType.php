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
     * @ORM\Column(type="string", length=255)
     */
    private $specialEffect;

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

    public function getSpecialEffect(): ?string
    {
        return $this->specialEffect;
    }

    public function setSpecialEffect(string $specialEffect): self
    {
        $this->specialEffect = $specialEffect;

        return $this;
    }
}
