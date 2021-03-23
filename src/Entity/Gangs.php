<?php

namespace App\Entity;

use App\Repository\GangsRepository;
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
    private $userId;

    /**
     * @ORM\Column(type="integer")
     */
    private $gangTypeId;

    /**
     * @ORM\Column(type="integer")
     */
    private $credits;

    /**
     * @ORM\Column(type="integer")
     */
    private $gangRating;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getGangTypeId(): ?int
    {
        return $this->gangTypeId;
    }

    public function setGangTypeId(int $gangTypeId): self
    {
        $this->gangTypeId = $gangTypeId;

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

    public function getGangRating(): ?int
    {
        return $this->gangRating;
    }

    public function setGangRating(int $gangRating): self
    {
        $this->gangRating = $gangRating;

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
}
