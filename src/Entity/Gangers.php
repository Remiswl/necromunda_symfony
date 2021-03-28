<?php

namespace App\Entity;

use App\Repository\GangersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GangersRepository::class)
 */
class Gangers
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
    private $gangerTypeId;

    /**
     * @ORM\Column(type="integer")
     */
    private $houseId;

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
    private $cool;

    /**
     * @ORM\Column(type="integer")
     */
    private $willpower;

    /**
     * @ORM\Column(type="integer")
     */
    private $intelligence;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGangerTypeId(): ?int
    {
        return $this->gangerTypeId;
    }

    public function setGangerTypeId(int $gangerTypeId): self
    {
        $this->gangerTypeId = $gangerTypeId;

        return $this;
    }

    public function getHouseId(): ?int
    {
        return $this->houseId;
    }

    public function setHouseId(int $houseId): self
    {
        $this->houseId = $houseId;

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

    public function getCool(): ?int
    {
        return $this->cool;
    }

    public function setCool(int $cool): self
    {
        $this->cool = $cool;

        return $this;
    }

    public function getWillpower(): ?int
    {
        return $this->willpower;
    }

    public function setWillpower(int $willpower): self
    {
        $this->willpower = $willpower;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence): self
    {
        $this->intelligence = $intelligence;

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
}
