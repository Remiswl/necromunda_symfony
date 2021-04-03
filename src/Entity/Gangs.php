<?php

namespace App\Entity;

use App\Repository\GangsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GangsRepository::class)
 */
class Gangs
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
    private $credits;

    /**
     * @ORM\Column(type="integer")
     */
    private $gangRating;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gangName;

    /**
     * @ORM\ManyToOne(targetEntity=Houses::class, inversedBy="gangs")
     */
    private $house;

    /**
     * @ORM\Column(type="integer")
     */
    private $reputation;

    /**
     * @ORM\Column(type="integer")
     */
    private $wealth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alliance;

    /**
     * @ORM\OneToMany(targetEntity=MyGangers::class, mappedBy="gang")
     */
    private $myGangers;

    /**
     * @ORM\ManyToMany(targetEntity=Territories::class, mappedBy="gang")
     */
    private $territories;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    public function __construct()
    {
        $this->myGangers = new ArrayCollection();
        $this->territories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCredits(): ?int
    {
        return $this->credits;
    }

    public function setCredits(int $credits): self
    {
        $this->credits = $credits;

        return $this;
    }

    public function getGangRating(): ?int
    {
        return $this->gangRating;
    }

    public function setGangRating(int $gangRating): self
    {
        $this->gangRating = $gangRating;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getGangName(): ?string
    {
        return $this->gangName;
    }

    public function setGangName(string $gangName): self
    {
        $this->gangName = $gangName;

        return $this;
    }

    public function getHouse(): ?Houses
    {
        return $this->house;
    }

    public function setHouse(?Houses $house): self
    {
        $this->house = $house;

        return $this;
    }

    public function getReputation(): ?int
    {
        return $this->reputation;
    }

    public function setReputation(int $reputation): self
    {
        $this->reputation = $reputation;

        return $this;
    }

    public function getWealth(): ?int
    {
        return $this->wealth;
    }

    public function setWealth(int $wealth): self
    {
        $this->wealth = $wealth;

        return $this;
    }

    public function getAlliance(): ?string
    {
        return $this->alliance;
    }

    public function setAlliance(string $alliance): self
    {
        $this->alliance = $alliance;

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
            $myGanger->setGang($this);
        }

        return $this;
    }

    public function removeMyGanger(MyGangers $myGanger): self
    {
        if ($this->myGangers->removeElement($myGanger)) {
            // set the owning side to null (unless already changed)
            if ($myGanger->getGang() === $this) {
                $myGanger->setGang(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Territories[]
     */
    public function getTerritories(): Collection
    {
        return $this->territories;
    }

    public function addTerritory(Territories $territory): self
    {
        if (!$this->territories->contains($territory)) {
            $this->territories[] = $territory;
            $territory->addGang($this);
        }

        return $this;
    }

    public function removeTerritory(Territories $territory): self
    {
        if ($this->territories->removeElement($territory)) {
            $territory->removeGang($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->gangName;
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

}
