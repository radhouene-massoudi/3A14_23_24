<?php

namespace App\Entity;

use App\Repository\MedRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

#[ORM\Entity(repositoryClass: MedRepository::class)]
class Med
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $cin = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column]
    private ?int $tel = null;

    #[ORM\ManyToOne(inversedBy: 'meds')]
    #[ORM\JoinColumn(name:'id_med_ref',referencedColumnName:'ref')]
    private ?Hop $hop = null;

    public function getCin(): ?int
    {
        return $this->cin;
    }
    public function setCin(int $cin)
    {
        $this->cin = $cin;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getHop(): ?Hop
    {
        return $this->hop;
    }

    public function setHop(?Hop $hop): static
    {
        $this->hop = $hop;

        return $this;
    }
}
