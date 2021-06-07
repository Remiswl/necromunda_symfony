<?php

namespace App\Entity;

use App\Repository\TerritoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="text")
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
     * @Assert\Range(min=11)
     **/
    private $mind66;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(max=66)
     * @Assert\GreaterThanOrEqual(propertyPath="minD66")
     */
    private $maxd66;

    /**
     * @ORM\OneToMany(targetEntity=GangTerritory::class, mappedBy="territory")
     */
    private $territory;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $count;

    public function __construct()
    {
        $this->gang = new ArrayCollection();
        $this->territory = new ArrayCollection();
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

    public function getMind66(): ?int
    {
        return $this->mind66;
    }

    public function setMind66(int $mind66): self
    {
        $this->mind66 = $mind66;

        return $this;
    }

    public function getMaxd66(): ?int
    {
        return $this->maxd66;
    }

    public function setMaxd66(int $maxd66): self
    {
        $this->maxd66 = $maxd66;

        return $this;
    }

    /**
     * @return Collection|GangTerritory[]
     */
    public function getTerritory(): Collection
    {
        return $this->territory;
    }

    public function addTerritory(GangTerritory $territory): self
    {
        if (!$this->territory->contains($territory)) {
            $this->territory[] = $territory;
            $territory->setTerritory($this);
        }

        return $this;
    }

    public function removeTerritory(GangTerritory $territory): self
    {
        if ($this->territory->removeElement($territory)) {
            // set the owning side to null (unless already changed)
            if ($territory->getTerritory() === $this) {
                $territory->setTerritory(null);
            }
        }

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): self
    {
        $this->count = $count;

        return $this;
    }
}
