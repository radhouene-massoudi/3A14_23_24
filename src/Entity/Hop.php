<?php

namespace App\Entity;

use App\Repository\HopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HopRepository::class)]
class Hop
{
    #[ORM\Id]
   
    #[ORM\Column]
    private ?int $ref = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\OneToMany(mappedBy: 'hop', targetEntity: Med::class, cascade: ['all'])]
    private Collection $meds;

    public function __construct()
    {
        $this->meds = new ArrayCollection();
    }

    public function getRef(): ?int
    {
        return $this->ref;
    }
    public function setRef(int $ref): static
    {
        $this->ref = $ref;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Med>
     */
    public function getMeds(): Collection
    {
        return $this->meds;
    }

    public function addMed(Med $med): static
    {
        if (!$this->meds->contains($med)) {
            $this->meds->add($med);
            $med->setHop($this);
        }

        return $this;
    }

    public function removeMed(Med $med): static
    {
        if ($this->meds->removeElement($med)) {
            // set the owning side to null (unless already changed)
            if ($med->getHop() === $this) {
                $med->setHop(null);
            }
        }

        return $this;
    }
}
