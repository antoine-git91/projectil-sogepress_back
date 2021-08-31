<?php

namespace App\Entity;

use App\Repository\NafSousClassesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NafSousClassesRepository::class)
 */
class NafSousClasses
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
     * @ORM\ManyToOne(targetEntity=NafClasses::class, inversedBy="nafSousClasses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $naf_classe;

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

    public function getNafClasse(): ?NafClasses
    {
        return $this->naf_classe;
    }

    public function setNafClasse(?NafClasses $naf_classe): self
    {
        $this->naf_classe = $naf_classe;

        return $this;
    }
}
