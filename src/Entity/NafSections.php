<?php

namespace App\Entity;

use App\Repository\NafSectionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NafSectionsRepository::class)
 */
class NafSections
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=NafDivisions::class, mappedBy="naf_sections")
     */
    private $nafDivisions;

    public function __construct()
    {
        $this->nafDivisions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|NafDivisions[]
     */
    public function getNafDivisions(): Collection
    {
        return $this->nafDivisions;
    }

    public function addNafDivision(NafDivisions $nafDivision): self
    {
        if (!$this->nafDivisions->contains($nafDivision)) {
            $this->nafDivisions[] = $nafDivision;
            $nafDivision->setNafSections($this);
        }

        return $this;
    }

    public function removeNafDivision(NafDivisions $nafDivision): self
    {
        if ($this->nafDivisions->removeElement($nafDivision)) {
            // set the owning side to null (unless already changed)
            if ($nafDivision->getNafSections() === $this) {
                $nafDivision->setNafSections(null);
            }
        }

        return $this;
    }
}
