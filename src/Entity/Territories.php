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
     * @ORM\Column(type="integer")
     */
    private $D66roll;

    /**
     * @ORM\ManyToMany(targetEntity=Gangs::class, inversedBy="territories")
     */
    private $gang;

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

    public function getD66roll(): ?int
    {
        return $this->D66roll;
    }

    public function setD66roll(int $D66roll): self
    {
        $this->D66roll = $D66roll;

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
}
