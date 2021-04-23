<?php

namespace App\Entity;

use App\Repository\WeaponsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WeaponsRepository::class)
 */
class Weapons
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
     * @ORM\Column(type="integer")
     */
    private $cost;

    /**
     * @ORM\ManyToOne(targetEntity=WeaponsCategories::class, inversedBy="weapons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=MyGangers::class, inversedBy="weapons")
     */
    private $ganger;

    public function __construct()
    {
        $this->ganger = new ArrayCollection();
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

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCategory(): ?WeaponsCategories
    {
        return $this->category;
    }

    public function setCategory(?WeaponsCategories $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|MyGangers[]
     */
    public function getGanger(): Collection
    {
        return $this->ganger;
    }

    public function addGanger(MyGangers $ganger): self
    {
        if (!$this->ganger->contains($ganger)) {
            $this->ganger[] = $ganger;
        }

        return $this;
    }

    public function removeGanger(MyGangers $ganger): self
    {
        $this->ganger->removeElement($ganger);

        return $this;
    }
}
