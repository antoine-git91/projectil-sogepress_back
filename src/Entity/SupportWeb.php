<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SupportWebRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SupportWebRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        "get", "post"
    ],
    itemOperations: [
        "get"
    ],
    attributes: [
        "security"=>"is_granted('ROLE_COMMERCIAL')"
    ],
    normalizationContext: ["groups" => ["supportWeb:read"]]
)]
class SupportWeb
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *     "supportWeb:read",
     *     "postCommandeSupportWeb:write"
     * })
     */
    private $url;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="supportWeb", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=TypePrestationWeb::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *     "supportWeb:read",
     *     "postCommandeSupportWeb:write",
     *     "getCommandesByClient:read"
     * })
     */
    private $typePrestation;

    /**
     * @ORM\ManyToOne(targetEntity=TypeSiteWeb::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *     "supportWeb:read",
     *     "postCommandeSupportWeb:write",
     *     "getCommandesByClient:read"
     * })
     */
    private $typeSite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({
     *    "supportWeb:read",
     *    "postCommandeSupportWeb:write",
     *    "getCommandesByClient:read"
     * })
     */
    private $server;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getTypePrestation(): ?TypePrestationWeb
    {
        return $this->typePrestation;
    }

    public function setTypePrestation(?TypePrestationWeb $typePrestation): self
    {
        $this->typePrestation = $typePrestation;

        return $this;
    }

    public function getTypeSite(): ?TypeSiteWeb
    {
        return $this->typeSite;
    }

    public function setTypeSite(?TypeSiteWeb $typeSite): self
    {
        $this->typeSite = $typeSite;

        return $this;
    }

    public function getServer(): ?string
    {
        return $this->server;
    }

    public function setServer(?string $server): self
    {
        $this->server = $server;

        return $this;
    }
}
