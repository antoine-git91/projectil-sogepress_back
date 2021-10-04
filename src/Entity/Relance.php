<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\RelanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RelanceRepository::class)
 * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_COMMERCIAL')"},
 *     normalizationContext={"groups"={"relance:read"}},
 *     denormalizationContext={"groups"={"relance:write"}}
 * )
 */
class Relance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("relance:read")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", name="type_relance")
     * @Groups({"relance:read", "relance:write", "client:read", "commande:read"})
     */
    private $typeRelance;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"relance:read", "relance:write", "client:read", "commande:read"})
     */
    private $objet;

    /**
     * @ORM\Column(type="text")
     * @Groups({"relance:read", "relance:write", "commande:read"})
     */
    private $contenu;

    /**
     * @ORM\Column(type="date", name="date_echeance")
     * @Groups({"relance:read", "relance:write", "client:read", "commande:read"})
     */
    private $dateEcheance;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"relance:read", "relance:write", "client:read", "commande:read"})
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="relances")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"relance:read", "relance:write"})
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="relances")
     * @Groups({"relance:read", "relance:write"})
     */
    private $commande;

    /**
     * @ORM\Column(type="datetime_immutable", name="created_at")
     * @Groups({"relance:read", "relance:write"})
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeRelance(): ?bool
    {
        return $this->typeRelance;
    }

    public function setTypeRelance(bool $typeRelance): self
    {
        $this->typeRelance = $typeRelance;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateEcheance(): ?\DateTimeInterface
    {
        return $this->dateEcheance;
    }

    public function setDateEcheance(\DateTimeInterface $dateEcheance): self
    {
        $this->dateEcheance = $dateEcheance;

        return $this;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

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

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
