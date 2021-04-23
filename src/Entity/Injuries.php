<?php

namespace App\Entity;

use App\Repository\InjuriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @Assert\Range(min=11)
     */
    private $minD66;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(max=66)
     */
    private $maxD66;

    /**
     * @ORM\ManyToMany(targetEntity=MyGangers::class, inversedBy="injuries")
     */
    private $gangers;

    public function __construct()
    {
        $this->gangers = new ArrayCollection();
    }

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

    public function getMinD66(): ?int
    {
        return $this->minD66;
    }

    public function setMinD66(int $minD66): self
    {
        $this->minD66 = $minD66;

        return $this;
    }

    public function getMaxD66(): ?int
    {
        return $this->maxD66;
    }

    public function setMaxD66(int $maxD66): self
    {
        $this->maxD66 = $maxD66;

        return $this;
    }

    /**
     * @return Collection|MyGangers[]
     */
    public function getGangers(): Collection
    {
        return $this->gangers;
    }

    public function addGanger(MyGangers $ganger): self
    {
        if (!$this->gangers->contains($ganger)) {
            $this->gangers[] = $ganger;
        }

        return $this;
    }

    public function removeGanger(MyGangers $ganger): self
    {
        $this->gangers->removeElement($ganger);

        return $this;
    }
}
