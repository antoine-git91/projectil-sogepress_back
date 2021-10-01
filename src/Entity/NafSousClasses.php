<?php

namespace App\Entity;

use App\Repository\NafSousClassesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * @Groups("client:read")
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity=NafClasses::class, inversedBy="nafSousClasses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nafClasse;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $code;

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
        return $this->nafClasse;
    }

    public function setNafClasse(?NafClasses $nafClasse): self
    {
        $this->nafClasse = $nafClasse;

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
