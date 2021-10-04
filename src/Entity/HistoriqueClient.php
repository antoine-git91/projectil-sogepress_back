<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\HistoriqueClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoriqueClientRepository::class)
 *  * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_COMMERCIAL')"},
 *     normalizationContext={"groups"={"historique:read"}},
 *     denormalizationContext={"groups"={"historique:write"}},
 *     collectionOperations = {"get", "post"},
 *     itemOperations = {"get", "put", "delete"}
 * )
 */
class HistoriqueClient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"historique:read", "user:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"historique:read", "historique:write"})
     */
    private $commentaire;

    /**
     * @ORM\Column(type="datetime_immutable", name="created_at")
     * @Groups({"historique:read", "historique:write"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="historiqueClients")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"historique:read", "historique:write"})
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Contact::class, inversedBy="historiqueClients")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"historique:read", "historique:write"})
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="historiqueClients")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"historique:read", "historique:write"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="historiqueClients")
     * @Groups({"historique:read", "historique:write"})
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=TypeHistorique::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"historique:read", "historique:write"})
     */
    private $typeHistorique;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    public function getTypeHistorique(): ?TypeHistorique
    {
        return $this->typeHistorique;
    }

    public function setTypeHistorique(?TypeHistorique $typeHistorique): self
    {
        $this->typeHistorique = $typeHistorique;

        return $this;
    }
}
