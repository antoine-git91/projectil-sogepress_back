<?php

namespace App\Entity;

use App\Repository\NafGroupesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NafGroupesRepository::class)
 */
class NafGroupes
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
     * @ORM\OneToMany(targetEntity=NafClasses::class, mappedBy="nafGroupe")
     */
    private $nafClasses;

    /**
     * @ORM\ManyToOne(targetEntity=NafDivisions::class, inversedBy="nafGroupes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nafDivisions;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $code;

    public function __construct()
    {
        $this->nafClasses = new ArrayCollection();
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
     * @return Collection|NafClasses[]
     */
    public function getNafClasses(): Collection
    {
        return $this->nafClasses;
    }

    public function addNafClass(NafClasses $nafClass): self
    {
        if (!$this->nafClasses->contains($nafClass)) {
            $this->nafClasses[] = $nafClass;
            $nafClass->setNafGroupe($this);
        }

        return $this;
    }

    public function removeNafClass(NafClasses $nafClass): self
    {
        if ($this->nafClasses->removeElement($nafClass)) {
            // set the owning side to null (unless already changed)
            if ($nafClass->getNafGroupe() === $this) {
                $nafClass->setNafGroupe(null);
            }
        }

        return $this;
    }

    public function getNafDivisions(): ?NafDivisions
    {
        return $this->nafDivisions;
    }

    public function setNafDivisions(?NafDivisions $nafDivisions): self
    {
        $this->nafDivisions = $nafDivisions;

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
