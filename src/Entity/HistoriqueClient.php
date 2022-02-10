<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\GetHistoriquesByClientController;
use App\Controller\GetHistoriquesByCommandeController;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\HistoriqueClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoriqueClientRepository::class)
 */
#[ ApiResource(
    collectionOperations: [
        "get",
        "getHistoriquesByClient" => [
            "method" => "GET",
            "controller" => GetHistoriquesByClientController::class,
            "path" => "getHistoriquesByClient/{id_client}",
            'read' => false,
            'openapi_context' => [
                'summary' => 'Récupère les historiques correspondants au client',
                'parameters' => [
                    ['in' => 'path',
                        'name' => 'id_client',
                        'schema' => [
                            'type' => 'integer']
                    ]
                ]
            ],
            "normalization_context" => ["groups" => ["getHistoriquesByClient:read"]]
        ],
        "getHistoriquesByCommande" => [
            "method" => "GET",
            "controller" => GetHistoriquesByCommandeController::class,
            "path" => "getHistoriquesByCommande/{id_commande}",
            'read' => false,
            'openapi_context' => [
                'summary' => 'Récupère les historiques correspondants à la commande',
                'parameters' => [
                    ['in' => 'path',
                        'name' => 'id_commande',
                        'schema' => [
                            'type' => 'integer']
                    ]
                ]
            ],
            "normalization_context" => ["groups" => ["getHistoriquesByCommande:read"]]
        ],
        "post"
    ],
    itemOperations: [
        "get",
        "put",
        "delete"
    ],
    attributes: ["security"=> "is_granted('ROLE_COMMERCIAL')"],
    denormalizationContext: ["groups"=> ["historique:write"]],
    normalizationContext: ["groups"=> ["historique:read"]]
)]
class HistoriqueClient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "historique:read",
     *     "getHistoriquesByClient:read",
     *     "getHistoriquesByCommande:read",
     *     "contact:read",
     *     "user:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({
     *     "historique:read",
     *     "getHistoriquesByClient:read",
     *     "getHistoriquesByCommande:read",
     *     "historique:write",
     *     "commande:read",
     *     "client:write",
     *     "postCommandeSupportPrint:write",
     *     "postCommandeSupportWeb:write",
     *     "postCommandeSupportMagazine:write",
     *     "postCommandeContenu:write",
     *     "postCommandeEncart:write",
     *     "postCommandeCommunity:write"
     * })
     */
    private $commentaire;

    /**
     * @ORM\Column(type="datetime_immutable", name="created_at")
     * @Groups({
     *     "historique:read",
     *     "getHistoriquesByClient:read",
     *     "getHistoriquesByCommande:read",
     *     "historique:write"
     * })
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="historiqueClients")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Groups({
     *     "historique:read",
     *     "historique:write",
     *     "commande:write",
     *     "postCommandeSupportPrint:write",
     *     "postCommandeSupportWeb:write",
     *     "postCommandeSupportMagazine:write",
     *     "postCommandeContenu:write",
     *     "postCommandeEncart:write",
     *     "postCommandeCommunity:write"
     * })
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Contact::class, inversedBy="historiqueClients")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     * @Groups({
     *     "historique:read",
     *     "getHistoriquesByClient:read",
     *     "getHistoriquesByCommande:read",
     *     "historique:write",
     *     "postCommandeSupportPrint:write",
     *     "postCommandeSupportWeb:write",
     *     "postCommandeSupportMagazine:write",
     *     "postCommandeContenu:write",
     *     "postCommandeEncart:write",
     *     "postCommandeCommunity:write",
     *     "client:write"
     * })
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="historiqueClients")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *     "historique:read",
     *     "historique:write",
     *     "postCommandeSupportPrint:write",
     *     "postCommandeSupportWeb:write",
     *     "postCommandeSupportMagazine:write",
     *     "postCommandeContenu:write",
     *     "postCommandeEncart:write",
     *     "postCommandeCommunity:write"
     * })
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="historiqueClients")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Groups({
     *     "historique:read",
     *     "historique:write"
     * })
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=TypeHistorique::class)
     * @ORM\JoinColumn(nullable=true)
     * @Groups({
     *     "historique:read",
     *     "getHistoriquesByClient:read",
     *     "getHistoriquesByCommande:read",
     *     "historique:write",
     *     "commande:read",
     *     "client:write"
     * })
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
