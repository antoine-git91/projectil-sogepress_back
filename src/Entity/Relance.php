<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\GetRelancesByClientController;
use App\Controller\GetRelancesByCommandeController;
use App\Controller\GetRelancesByUserController;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\RelanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RelanceRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        "get",
        "getRelancesByUser" => [
            "method" => "get",
            "pagination_enabled" => false,
            "path" => "/getRelancesByUser/{id_user}",
            "controller" => GetRelancesByUserController::class,
            'read' => false,
            'openapi_context' => [
                'summary' => 'Récupère les relances correspondantes au user connecté',
                'parameters' => [
                    ['in' => 'path',
                        'name' => 'id_user',
                        'schema' => [
                            'type' => 'integer']
                    ]
                ],
            ],
            "normalization_context" => ["groups" => ["getRelancesByUser:read"]]
        ],
        "getRelancesByClient" => [
            "pagination_enabled" => false,
            "method" => "get",
            "path" => "/getRelancesByClient/{id_client}",
            "controller" => GetRelancesByClientController::class,
            'read' => false,
            'openapi_context' => [
                'summary' => 'Récupère les relances correspondantes au client',
                'parameters' => [
                    ['in' => 'path',
                        'name' => 'id_client',
                        'schema' => [
                            'type' => 'integer']
                    ]
                ],
            ],
            "normalization_context" => ["groups" => ["getRelancesByClient:read"]]
        ],
        "getRelancesByCommande" => [
            "pagination_enabled" => false,
            "method" => "get",
            "path" => "/getRelancesByCommande/{id_commande}",
            "controller" => GetRelancesByCommandeController::class,
            'read' => false,
            'openapi_context' => [
                'summary' => 'Récupère les relances correspondantes à la commande',
                'parameters' => [
                    ['in' => 'path',
                        'name' => 'id_commande',
                        'schema' => [
                            'type' => 'integer']
                    ]
                ],
            ],
            "normalization_context" => ["groups" => ["getRelancesByCommande:read"]]
        ],
        "post"
    ],
    attributes: [
        "security"=>"is_granted('ROLE_COMMERCIAL')",
        "pagination_items_per_page" => 20,
    ],
    denormalizationContext: ["groups" => ["relance:write"]],
    normalizationContext: ["groups" => ["relance:read"]]
)]
class Relance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "relance:read",
     *     "getRelancesByUser:read",
     *     "getRelancesByCommande:read",
     *     "getRelancesByClient:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", name="type_relance")
     * @Groups({
     *     "relance:read",
     *     "relance:write",
     *     "getRelancesByUser:read",
     *     "getRelancesByCommande:read",
     *     "getRelancesByClient:read"
     * })
     */
    private $typeRelance;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "relance:read",
     *     "relance:write",
     *     "getRelancesByUser:read",
     *     "getRelancesByCommande:read",
     *     "getRelancesByClient:read"
     * })
     */
    private $objet;

    /**
     * @ORM\Column(type="text")
     * @Groups({
     *     "relance:read",
     *     "relance:write",
     *     "getRelancesByUser:read",
     *     "getRelancesByCommande:read",
     *     "getRelancesByClient:read"
     * })
     */
    private $contenu;

    /**
     * @ORM\Column(type="date", name="date_echeance")
     * @Groups({
     *     "relance:read",
     *     "relance:write",
     *     "getRelancesByUser:read",
     *     "getRelancesByCommande:read",
     *     "getRelancesByClient:read"
     * })
     */
    private $dateEcheance;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="relances")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Groups({
     *     "relance:read",
     *     "relance:write",
     *     "getRelancesByUser:read",
     *     "getRelancesByCommande:read",
     *     "getRelancesByClient:read"
     * })
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="relances")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Groups({
     *     "relance:read",
     *     "relance:write",
     *     "getRelancesByUser:read",
     *     "getRelancesByCommande:read",
     *     "getRelancesByClient:read"
     * })
     */
    private $commande;

    /**
     * @ORM\Column(type="datetime_immutable", name="created_at")
     * @Groups({
     *     "relance:read",
     *     "relance:write"
     * })
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="relance")
     * @Groups({
     *     "relance:read",
     *     "relance:write",
     *     "getRelancesByUser:read"
     * })
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=RelanceStatus::class, inversedBy="relances")
     * @Groups({
     *     "relance:read",
     *     "relance:write",
     *     "getRelancesByUser:read",
     *     "getRelancesByCommande:read",
     *     "getRelancesByCommande:read",
     *     "getRelancesByClient:read",
     * })
     */
    private $status;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStatus(): ?RelanceStatus
    {
        return $this->status;
    }

    public function setStatus(?RelanceStatus $status): self
    {
        $this->status = $status;

        return $this;
    }
}
