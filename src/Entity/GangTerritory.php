<?php

namespace App\Entity;

use App\Repository\GangTerritoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GangTerritoryRepository::class)
 */
class GangTerritory
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
    private $count;

    /**
     * @ORM\ManyToOne(targetEntity=Gangs::class, inversedBy="gang")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gang;

    /**
     * @ORM\ManyToOne(targetEntity=Territories::class, inversedBy="territory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $territory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

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

    public function getTerritory(): ?Territories
    {
        return $this->territory;
    }

    public function setTerritory(?Territories $territory): self
    {
        $this->territory = $territory;

        return $this;
    }
}
