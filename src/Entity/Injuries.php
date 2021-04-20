<?php

namespace App\Entity;

use App\Repository\InjuriesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=11, max=66)
     */
    private $d66;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getD66(): ?int
    {
        return $this->d66;
    }

    public function setD66(int $d66): self
    {
        $this->d66 = $d66;

        return $this;
    }
}
