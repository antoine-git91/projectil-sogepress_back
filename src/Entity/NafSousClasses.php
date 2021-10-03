<?php

namespace App\Entity;

use App\Repository\NafSousClassesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=NafSousClassesRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"naf_sous_classe:read"}},
 *     denormalizationContext={"groups"={"naf_sous_classe:write"}},
 *     collectionOperations = {"get"},
 *     itemOperations = {"get"}
 * )
 */
class NafSousClasses
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"naf_sous_classe:read", "client:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"naf_sous_classe:read", "client:read"})
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity=NafClasses::class, inversedBy="nafSousClasses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nafClasse;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"naf_sous_classe:read", "client:read"})
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
