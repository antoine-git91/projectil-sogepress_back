<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\MagazinesByClientController;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\MagazineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MagazineRepository::class)
 * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_COMMERCIAL')"},
 *     normalizationContext={"groups"={"magazine:read"}},
 *     denormalizationContext={"groups"={"magazine:write"}},
 *     collectionOperations = {"get", "post"},
 *     itemOperations = {"get", "put", "delete"}
 * )
 */
#[ApiResource(
    collectionOperations: [
        "get",
        "getMagazinesByClient" => [
            'pagination_enabled' => false,
            'path' => '/magazinesByClient/{id_client}',
            "controller" => MagazinesByClientController::class,
            'method' => 'get',
            'read' => false,
            'openapi_context' => [
                'summary' => 'Récupère les magazines correspondants au client',
                'parameters' => [
                    ['in' => 'path',
                        'name' => 'id_client',
                        'schema' => [
                            'type' => 'integer']
                    ]
                ]
            ]

        ],
        "post"
    ],
    itemOperations: [
        "get",
        "put",
        "delete"
    ],
    attributes: ["security" => "is_granted('ROLE_COMMERCIAL')"],
    denormalizationContext: ["groups" => ["magazine:write"]],
    normalizationContext: ["groups" => ["magazine:read"]]
)]
class Magazine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "magazine:read",
     *     "client:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "magazine:read",
     *     "magazine:write",
     *     "client:read"
     * })
     */
    private $nom;


    /**
     * @ORM\OneToMany(targetEntity=Potentialite::class, mappedBy="magazine", cascade={"persist"}, orphanRemoval=true)
     * @Groups({
     *     "magazine:read",
     * })
     * @Assert\Valid
     */
    private $potentialites;

    /**
     * @ORM\OneToMany(targetEntity=SupportMagazine::class, mappedBy="magazine")
     */
    private $supportMagazine;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="magazine")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Groups({
     *     "magazine:read",
     *     "magazine:write",
     * })
     */
    private $client;


    public function __construct()
    {
        $this->potentialites = new ArrayCollection();
        $this->supportMagazine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Potentialite[]
     */
    public function getPotentialites(): Collection
    {
        return $this->potentialites;
    }

    public function addPotentialite(Potentialite $potentialite): self
    {
        if (!$this->potentialites->contains($potentialite)) {
            $this->potentialites[] = $potentialite;
            $potentialite->setMagazine($this);
        }

        return $this;
    }

    public function removePotentialite(Potentialite $potentialite): self
    {
        if ($this->potentialites->removeElement($potentialite)) {
            // set the owning side to null (unless already changed)
            if ($potentialite->getMagazine() === $this) {
                $potentialite->setMagazine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SupportMagazine[]
     */
    public function getSupportMagazine(): Collection
    {
        return $this->supportMagazine;
    }

    public function addSupportMagazine(SupportMagazine $supportMagazine): self
    {
        if (!$this->supportMagazine->contains($supportMagazine)) {
            $this->supportMagazine[] = $supportMagazine;
            $supportMagazine->setMagazine($this);
        }

        return $this;
    }

    public function removeSupportMagazine(SupportMagazine $supportMagazine): self
    {
        if ($this->supportMagazine->removeElement($supportMagazine)) {
            // set the owning side to null (unless already changed)
            if ($supportMagazine->getMagazine() === $this) {
                $supportMagazine->setMagazine(null);
            }
        }

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
}
