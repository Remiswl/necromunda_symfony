<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
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
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gangName;

    /**
     * @ORM\Column(type="integer")
     */
    private $gangTypeId;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getGangTypeId(): ?int
    {
        return $this->gangTypeId;
    }

    public function setGangTypeId(int $gangTypeId): self
    {
        $this->gangTypeId = $gangTypeId;

        return $this;
    }
}
