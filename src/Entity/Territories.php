<?php

namespace App\Entity;

use App\Repository\TerritoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TerritoriesRepository::class)
 */
class Territories
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
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $income;

    /**
     * @ORM\ManyToMany(targetEntity=Gangs::class, inversedBy="territories")
     */
    private $gang;

    /**
     * @ORM\Column(type="integer")
     */
    private $D6tens;

    /**
     * @ORM\Column(type="integer")
     */
    private $D6units;

    public function __construct()
    {
        $this->gang = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIncome(): ?string
    {
        return $this->income;
    }

    public function setIncome(string $income): self
    {
        $this->income = $income;

        return $this;
    }

    /**
     * @return Collection|Gangs[]
     */
    public function getGang(): Collection
    {
        return $this->gang;
    }

    public function addGang(Gangs $gang): self
    {
        if (!$this->gang->contains($gang)) {
            $this->gang[] = $gang;
        }

        return $this;
    }

    public function removeGang(Gangs $gang): self
    {
        $this->gang->removeElement($gang);

        return $this;
    }

    public function getD6tens(): ?int
    {
        return $this->D6tens;
    }

    public function setD6tens(int $D6tens): self
    {
        $this->D6tens = $D6tens;

        return $this;
    }

    public function getD6units(): ?int
    {
        return $this->D6units;
    }

    public function setD6units(int $D6units): self
    {
        $this->D6units = $D6units;

        return $this;
    }
}
