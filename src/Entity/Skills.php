<?php

namespace App\Entity;

use App\Repository\SkillsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillsRepository::class)
 */
class Skills
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
     * @ORM\ManyToOne(targetEntity=SkillsCategories::class, inversedBy="skills")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=MyGangers::class, inversedBy="skills")
     */
    private $ganger;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?SkillsCategories
    {
        return $this->category;
    }

    public function setCategory(?SkillsCategories $category): self
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
}
