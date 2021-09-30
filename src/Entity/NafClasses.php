<?php

namespace App\Entity;

use App\Repository\NafClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NafClassesRepository::class)
 */
class NafClasses
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
     * @ORM\OneToMany(targetEntity=NafSousClasses::class, mappedBy="naf_classe")
     */
    private $nafSousClasses;

    /**
     * @ORM\ManyToOne(targetEntity=NafGroupes::class, inversedBy="nafClasses", name="naf_groupe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nafGroupe;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $code;

    public function __construct()
    {
        $this->nafSousClasses = new ArrayCollection();
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
     * @return Collection|NafSousClasses[]
     */
    public function getNafSousClasses(): Collection
    {
        return $this->nafSousClasses;
    }

    public function addNafSousClass(NafSousClasses $nafSousClass): self
    {
        if (!$this->nafSousClasses->contains($nafSousClass)) {
            $this->nafSousClasses[] = $nafSousClass;
            $nafSousClass->setNafClasse($this);
        }

        return $this;
    }

    public function removeNafSousClass(NafSousClasses $nafSousClass): self
    {
        if ($this->nafSousClasses->removeElement($nafSousClass)) {
            // set the owning side to null (unless already changed)
            if ($nafSousClass->getNafClasse() === $this) {
                $nafSousClass->setNafClasse(null);
            }
        }

        return $this;
    }

    public function getNafGroupe(): ?NafGroupes
    {
        return $this->nafGroupe;
    }

    public function setNafGroupe(?NafGroupes $nafGroupe): self
    {
        $this->nafGroupe = $nafGroupe;

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
