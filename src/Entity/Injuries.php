<?php

namespace App\Entity;

use App\Repository\InjuriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InjuriesRepository::class)
 */
class Injuries
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
    private $d6tens;

    /**
     * @ORM\Column(type="integer")
     */
    private $d6units;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getD6tens(): ?int
    {
        return $this->d6tens;
    }

    public function setD6tens(int $d6tens): self
    {
        $this->d6tens = $d6tens;

        return $this;
    }

    public function getD6units(): ?int
    {
        return $this->d6units;
    }

    public function setD6units(int $d6units): self
    {
        $this->d6units = $d6units;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
