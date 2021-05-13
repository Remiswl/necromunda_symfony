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

    /**
     * @ORM\Column(type="integer")
     */
    private $availability;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shortRange;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $longRange;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shortAccuracy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $longAccuracy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $strength;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $armourPiercing;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $damage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ammo;

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

    public function getAvailability(): ?int
    {
        return $this->availability;
    }

    public function setAvailability(int $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getShortRange(): ?int
    {
        return $this->shortRange;
    }

    public function setShortRange(?int $shortRange): self
    {
        $this->shortRange = $shortRange;

        return $this;
    }

    public function getLongRange(): ?int
    {
        return $this->longRange;
    }

    public function setLongRange(?int $longRange): self
    {
        $this->longRange = $longRange;

        return $this;
    }

    public function getShortAccuracy(): ?int
    {
        return $this->shortAccuracy;
    }

    public function setShortAccuracy(?int $shortAccuracy): self
    {
        $this->shortAccuracy = $shortAccuracy;

        return $this;
    }

    public function getLongAccuracy(): ?int
    {
        return $this->longAccuracy;
    }

    public function setLongAccuracy(?int $longAccuracy): self
    {
        $this->longAccuracy = $longAccuracy;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(?int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getArmourPiercing(): ?int
    {
        return $this->armourPiercing;
    }

    public function setArmourPiercing(?int $armourPiercing): self
    {
        $this->armourPiercing = $armourPiercing;

        return $this;
    }

    public function getDamage(): ?int
    {
        return $this->damage;
    }

    public function setDamage(?int $damage): self
    {
        $this->damage = $damage;

        return $this;
    }

    public function getAmmo(): ?int
    {
        return $this->ammo;
    }

    public function setAmmo(?int $ammo): self
    {
        $this->ammo = $ammo;

        return $this;
    }
}
