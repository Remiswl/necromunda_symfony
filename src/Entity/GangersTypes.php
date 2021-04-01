<?php

namespace App\Entity;

use App\Repository\GangersTypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GangersTypesRepository::class)
 */
class GangersTypes
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
     * @ORM\OneToMany(targetEntity=MyGangers::class, mappedBy="gangerType")
     */
    private $myGangers;

    /**
     * @ORM\OneToMany(targetEntity=Gangers::class, mappedBy="type")
     */
    private $gangers;

    public function __construct()
    {
        $this->myGangers = new ArrayCollection();
        $this->gangers = new ArrayCollection();
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

    /**
     * @return Collection|MyGangers[]
     */
    public function getMyGangers(): Collection
    {
        return $this->myGangers;
    }

    public function addMyGanger(MyGangers $myGanger): self
    {
        if (!$this->myGangers->contains($myGanger)) {
            $this->myGangers[] = $myGanger;
            $myGanger->setGangerType($this);
        }

        return $this;
    }

    public function removeMyGanger(MyGangers $myGanger): self
    {
        if ($this->myGangers->removeElement($myGanger)) {
            // set the owning side to null (unless already changed)
            if ($myGanger->getGangerType() === $this) {
                $myGanger->setGangerType(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->name;
    }

    /**
     * @return Collection|Gangers[]
     */
    public function getGangers(): Collection
    {
        return $this->gangers;
    }

    public function addGanger(Gangers $ganger): self
    {
        if (!$this->gangers->contains($ganger)) {
            $this->gangers[] = $ganger;
            $ganger->setType($this);
        }

        return $this;
    }

    public function removeGanger(Gangers $ganger): self
    {
        if ($this->gangers->removeElement($ganger)) {
            // set the owning side to null (unless already changed)
            if ($ganger->getType() === $this) {
                $ganger->setType(null);
            }
        }

        return $this;
    }
}