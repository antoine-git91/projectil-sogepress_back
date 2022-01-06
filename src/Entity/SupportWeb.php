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
    ]
)]
class SupportWeb
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"commande:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"commande:read", "postCommandeSupportWeb:write"})
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
     * @Groups({"commande:read", "postCommandeSupportWeb:write"})
     */
    private $typePrestation;

    /**
     * @ORM\ManyToOne(targetEntity=TypeSiteWeb::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"commande:read", "postCommandeSupportWeb:write"})
     */
    private $typeSite;

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
}
