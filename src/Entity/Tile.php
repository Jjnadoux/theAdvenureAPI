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
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $specialEffect;

    /**
     * @ORM\Column(type="integer")
     */
    private $monster;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

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

    public function getMonster(): ?int
    {
        return $this->monster;
    }

    public function setMonster(int $monster): self
    {
        $this->monster = $monster;

        return $this;
    }
}
