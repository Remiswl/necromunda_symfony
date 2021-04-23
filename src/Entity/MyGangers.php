<?php

namespace App\Entity;

use App\Repository\MyGangersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MyGangersRepository::class)
 */
class MyGangers
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
    private $credits;

    /**
     * @ORM\Column(type="integer")
     */
    private $move;

    /**
     * @ORM\Column(type="integer")
     */
    private $weaponSkill;

    /**
     * @ORM\Column(type="integer")
     */
    private $ballisticSkill;

    /**
     * @ORM\Column(type="integer")
     */
    private $strength;

    /**
     * @ORM\Column(type="integer")
     */
    private $toughness;

    /**
     * @ORM\Column(type="integer")
     */
    private $wounds;

    /**
     * @ORM\Column(type="integer")
     */
    private $initiative;

    /**
     * @ORM\Column(type="integer")
     */
    private $attacks;

    /**
     * @ORM\Column(type="integer")
     */
    private $leadership;

    /**
     * @ORM\Column(type="integer")
     */
    private $cost;

    /**
     * @ORM\Column(type="integer")
     */
    private $adv;

    /**
     * @ORM\Column(type="integer")
     */
    private $xp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=GangersTypes::class, inversedBy="myGangers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gangerType;

    /**
     * @ORM\ManyToOne(targetEntity=Gangs::class, inversedBy="myGangers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gang;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Weapons::class, mappedBy="ganger")
     */
    private $weapons;

    /**
     * @ORM\ManyToMany(targetEntity=Skills::class, mappedBy="ganger")
     */
    private $skills;

    /**
     * @ORM\ManyToMany(targetEntity=Injuries::class, mappedBy="gangers")
     */
    private $injuries;

    public function __construct()
    {
        $this->type = new ArrayCollection();
        $this->weapons = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->injuries = new ArrayCollection();
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

    public function getCredits(): ?int
    {
        return $this->credits;
    }

    public function setCredits(int $credits): self
    {
        $this->credits = $credits;

        return $this;
    }

    public function getMove(): ?int
    {
        return $this->move;
    }

    public function setMove(int $move): self
    {
        $this->move = $move;

        return $this;
    }

    public function getWeaponSkill(): ?int
    {
        return $this->weaponSkill;
    }

    public function setWeaponSkill(int $weaponSkill): self
    {
        $this->weaponSkill = $weaponSkill;

        return $this;
    }

    public function getBallisticSkill(): ?int
    {
        return $this->ballisticSkill;
    }

    public function setBallisticSkill(int $ballisticSkill): self
    {
        $this->ballisticSkill = $ballisticSkill;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getToughness(): ?int
    {
        return $this->toughness;
    }

    public function setToughness(int $toughness): self
    {
        $this->toughness = $toughness;

        return $this;
    }

    public function getWounds(): ?int
    {
        return $this->wounds;
    }

    public function setWounds(int $wounds): self
    {
        $this->wounds = $wounds;

        return $this;
    }

    public function getInitiative(): ?int
    {
        return $this->initiative;
    }

    public function setInitiative(int $initiative): self
    {
        $this->initiative = $initiative;

        return $this;
    }

    public function getAttacks(): ?int
    {
        return $this->attacks;
    }

    public function setAttacks(int $attacks): self
    {
        $this->attacks = $attacks;

        return $this;
    }

    public function getLeadership(): ?int
    {
        return $this->leadership;
    }

    public function setLeadership(int $leadership): self
    {
        $this->leadership = $leadership;

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

    public function getAdv(): ?int
    {
        return $this->adv;
    }

    public function setAdv(int $adv): self
    {
        $this->adv = $adv;

        return $this;
    }

    public function getXp(): ?int
    {
        return $this->xp;
    }

    public function setXp(int $xp): self
    {
        $this->xp = $xp;

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

    public function getGangerType(): ?GangersTypes
    {
        return $this->gangerType;
    }

    public function setGangerType(?GangersTypes $gangerType): self
    {
        $this->gangerType = $gangerType;

        return $this;
    }

    public function getGang(): ?Gangs
    {
        return $this->gang;
    }

    public function setGang(?Gangs $gang): self
    {
        $this->gang = $gang;

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

    /**
     * @return Collection|Weapons[]
     */
    public function getWeapons(): Collection
    {
        return $this->weapons;
    }

    public function addWeapon(Weapons $weapon): self
    {
        if (!$this->weapons->contains($weapon)) {
            $this->weapons[] = $weapon;
            $weapon->addGanger($this);
        }

        return $this;
    }

    public function removeWeapon(Weapons $weapon): self
    {
        if ($this->weapons->removeElement($weapon)) {
            $weapon->removeGanger($this);
        }

        return $this;
    }

    /**
     * @return Collection|Skills[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skills $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->addGanger($this);
        }

        return $this;
    }

    public function removeSkill(Skills $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            $skill->removeGanger($this);
        }

        return $this;
    }

    /**
     * @return Collection|Injuries[]
     */
    public function getInjuries(): Collection
    {
        return $this->injuries;
    }

    public function addInjury(Injuries $injury): self
    {
        if (!$this->injuries->contains($injury)) {
            $this->injuries[] = $injury;
            $injury->addGanger($this);
        }

        return $this;
    }

    public function removeInjury(Injuries $injury): self
    {
        if ($this->injuries->removeElement($injury)) {
            $injury->removeGanger($this);
        }

        return $this;
    }
}
