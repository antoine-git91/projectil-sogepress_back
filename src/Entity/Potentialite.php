<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\GetPotentialCustomersController;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\PotentialitesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PotentialitesRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        "get",
        "getPotentialCustomers" => [
            'path' => '/getPotentialCustomers/{id_magazine}',
            "controller" => GetPotentialCustomersController::class,
            'method' => 'get',
            'read' => false,
            'openapi_context' => [
                'summary' => 'Récupère les clients potentiels d\'une commande de type régie',
                'parameters' => [
                    ['in' => 'path',
                        'name' => 'id_magazine',
                        'schema' => [
                            'type' => 'integer']
                    ]
                ]
            ],
            "normalization_context" => ["groups" => ["getPotentialCustomers:read"]]
        ],
        "post"
    ],
    itemOperations: [
        "get",
        "put",
        "delete"
    ],
    attributes: ["security"=>"is_granted('ROLE_COMMERCIAL')"],
    denormalizationContext: ["groups"=>["potentialite:write"]],
    normalizationContext: ["groups"=>["potentialite:read"]],

)]
class Potentialite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "potentialite:read",
     *     "client:read",
     *     "magazine:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({
     *     "potentialite:read",
     *     "potentialite:write",
     *     "client:read",
     *     "magazine:write"
     * })
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="potentialites")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Groups({
     *     "potentialite:read",
     *      "potentialite:write",
     *     "magazine:write",
     *     "getPotentialCustomers:read"
     * })
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Magazine::class, inversedBy="potentialites")
     * @Groups({
     *     "potentialite:read",
     *     "potentialite:write",
     *     "client:read",
     *     "client:write"
     * })
     */
    private $magazine;

    /**
     * @ORM\ManyToOne(targetEntity=TypePotentialite::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *     "potentialite:read",
     *     "potentialite:write",
     *     "client:read",
     *     "client:write",
     *     "magazine:write"
     * })
     */
    private $typePotentialite;

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
        return $this->typePotentialite;
    }

    public function setTypePotentialite(?TypePotentialite $typePotentialite): self
    {
        $this->typePotentialite = $typePotentialite;

        return $this;
    }
}
