<?php

namespace App\Entity;

use App\Repository\HousesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HousesRepository::class)
 */
class Houses
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
    private $image;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Gangs::class, mappedBy="house")
     */
    private $gangs;

    public function __construct()
    {
        $this->gangs = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    /**
     * @return Collection|Gangs[]
     */
    public function getGangs(): Collection
    {
        return $this->gangs;
    }

    public function addGang(Gangs $gang): self
    {
        if (!$this->gangs->contains($gang)) {
            $this->gangs[] = $gang;
            $gang->setHouse($this);
        }

        return $this;
    }

    public function removeGang(Gangs $gang): self
    {
        if ($this->gangs->removeElement($gang)) {
            // set the owning side to null (unless already changed)
            if ($gang->getHouse() === $this) {
                $gang->setHouse(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
