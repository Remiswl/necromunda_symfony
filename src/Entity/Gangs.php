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
    private $houseId;

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

    public function getId(): ?int
    {
        return $this->id;
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

    public function setGangName(string $gang_name): self
    {
        $this->gang_name = $gangName;

        return $this;
    }
}
