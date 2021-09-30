<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\HistoriqueClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"historique:read"}},
 *     denormalizationContext={"groups"={"historique:write"}}
 * )
 * @ORM\Entity(repositoryClass=HistoriqueClientRepository::class)
 */
class HistoriqueClient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"historique:read", "contact:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"historique:read", "historique:write", "client:read", "commande:read"})
     */
    private $commentaire;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups("historique:read")
     */
    private $created_at;

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
     * @Groups({"historique:read", "historique:write", "client:read", "commande:read"})
     */
    private $type_historique;

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
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

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
        return $this->type_historique;
    }

    public function setTypeHistorique(?TypeHistorique $type_historique): self
    {
        $this->type_historique = $type_historique;

        return $this;
    }
}
