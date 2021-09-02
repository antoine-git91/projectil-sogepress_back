<?php

namespace App\Entity;

use App\Repository\NafDivisionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NafDivisionsRepository::class)
 */
class NafDivisions
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
     * @ORM\OneToMany(targetEntity=NafGroupes::class, mappedBy="naf_divisions")
     */
    private $nafGroupes;

    /**
     * @ORM\ManyToOne(targetEntity=NafSections::class, inversedBy="nafDivisions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $naf_sections;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $code;

    public function __construct()
    {
        $this->nafGroupes = new ArrayCollection();
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
     * @return Collection|NafGroupes[]
     */
    public function getNafGroupes(): Collection
    {
        return $this->nafGroupes;
    }

    public function addNafGroupe(NafGroupes $nafGroupe): self
    {
        if (!$this->nafGroupes->contains($nafGroupe)) {
            $this->nafGroupes[] = $nafGroupe;
            $nafGroupe->setNafDivisions($this);
        }

        return $this;
    }

    public function removeNafGroupe(NafGroupes $nafGroupe): self
    {
        if ($this->nafGroupes->removeElement($nafGroupe)) {
            // set the owning side to null (unless already changed)
            if ($nafGroupe->getNafDivisions() === $this) {
                $nafGroupe->setNafDivisions(null);
            }
        }

        return $this;
    }

    public function getNafSections(): ?NafSections
    {
        return $this->naf_sections;
    }

    public function setNafSections(?NafSections $naf_sections): self
    {
        $this->naf_sections = $naf_sections;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
