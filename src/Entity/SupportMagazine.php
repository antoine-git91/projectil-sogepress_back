<?php

namespace App\Entity;

use App\Controller\EditionsByMagazineController;
use App\Repository\SupportMagazineRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SupportMagazineRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        "get",
        "getEditionsByMagazine" => [
            'pagination_enabled' => false,
            'path' => '/editionsByMagazine/{magazine_id}',
            "controller" => EditionsByMagazineController::class,
            'method' => 'get',
            'read' => false,
            'openapi_context' => [
                'summary' => 'Récupère les éditions correspondantes au magazine',
                'parameters' => [
                    ['in' => 'path',
                        'name' => 'magazine_id',
                        'schema' => [
                            'type' => 'integer']
                    ]
                ]
            ]
        ],
        "post",
    ],
    itemOperations: [
        "get"
    ],
    attributes: [
        "security" => "is_granted('ROLE_COMMERCIAL')"
    ],normalizationContext: ["groups" => ["supportMagazine:read"]]
)]
class SupportMagazine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "supportMagazine:read",
     *     "encart:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({
     *     "supportMagazine:read",
     *     "postCommandeSupportMagazine:write",
     *     "editionsByMagazine:read"
     * })
     */
    private $pages;

    /**
     * @ORM\Column(type="integer")
     * @Groups({
     *     "supportMagazine:read",
     *     "postCommandeSupportMagazine:write",
     *     "editionsByMagazine:read"
     * })
     */
    private $quantite;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="supportMagazine")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Groups ({
     *      "supportMagazine:read"
     * })
     */
    private $commande;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "supportMagazine:read",
     *     "postCommandeSupportMagazine:write",
     *     "relance:read",
     *     "getCommandesByClient:read",
     *     "encart:read"
     * })
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Magazine::class, inversedBy="supportMagazine")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Groups({
     *     "supportMagazine:read",
     *     "postCommandeSupportMagazine:write",
     *     "relance:read",
     *     "getCommandesByClient:read",
     *     "encart:read"
     * })
     */
    private $magazine;

    /**
     * @ORM\OneToMany(targetEntity=Encart::class, mappedBy="supportMagazine")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $encart;

    public function __construct()
    {
        $this->encart = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPages(): ?int
    {
        return $this->pages;
    }

    public function setPages(int $pages): self
    {
        $this->pages = $pages;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
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

    public function getMagazine(): ?Magazine
    {
        return $this->magazine;
    }

    public function setMagazine(?Magazine $magazine): self
    {
        $this->magazine = $magazine;

        return $this;
    }

    /**
     * @return Collection|Encart[]
     */
    public function getEncart(): Collection
    {
        return $this->encart;
    }

    public function addEncart(Encart $encart): self
    {
        if (!$this->encart->contains($encart)) {
            $this->encart[] = $encart;
            $encart->setSupportMagazine($this);
        }

        return $this;
    }

    public function removeEncart(Encart $encart): self
    {
        if ($this->encart->removeElement($encart)) {
            // set the owning side to null (unless already changed)
            if ($encart->getSupportMagazine() === $this) {
                $encart->setSupportMagazine(null);
            }
        }

        return $this;
    }
}
