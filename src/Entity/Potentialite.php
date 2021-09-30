<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\PotentialitesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"potentialite:read"}},
 *     denormalizationContext={"groups"={"potentialite:write"}}
 * )
 * @ORM\Entity(repositoryClass=PotentialitesRepository::class)
 */
class Potentialite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"potentialites:read", "magazine:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"potentialite:read", "potentialite:write"})
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="potentialites")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"potentialite:read", "potentialite:write"})
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Magazine::class, inversedBy="potentialites")
     * @Groups({"potentialite:read", "potentialite:write"})
     */
    private $magazine;

    /**
     * @ORM\ManyToOne(targetEntity=TypePotentialite::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"potentialite:read", "potentialite:write"})
     */
    private $type_potentialite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getMagazine(): ?Magazine
    {
        return $this->magazine;
    }

    public function setMagazine(?Magazine $magazine): self
    {
        $this->magazine = $magazine;

        return $this;
    }

    public function getTypePotentialite(): ?TypePotentialite
    {
        return $this->type_potentialite;
    }

    public function setTypePotentialite(?TypePotentialite $type_potentialite): self
    {
        $this->type_potentialite = $type_potentialite;

        return $this;
    }
}
