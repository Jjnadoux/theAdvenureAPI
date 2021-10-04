<?php

namespace App\Entity;

use App\Repository\LogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LogRepository::class)
 */
class Log
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateLog;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     *@var \App\Entity\Adventure
     * @ORM\ManyToOne(targetEntity="App\Entity\Adventure")
     */
    private $adventure;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getDateLog()
    {
        return $this->dateLog;
    }

    public function setDateLog($dateLog): self
    {
        $this->dateLog = $dateLog;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getAdventure()
    {
        return $this->adventure;
    }

    public function setAdventure($adventure): self
    {
        $this->adventure = $adventure;

        return $this;
    }
}
