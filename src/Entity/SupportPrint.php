<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SupportPrintRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SupportPrintRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        "get",
        "post"
    ],
    itemOperations: ["get"],
    attributes: [
        "security"=>"is_granted('ROLE_COMMERCIAL')"
    ],
    denormalizationContext: [
        "groups" => ["support_print:write"]
    ],
    normalizationContext: [
        "groups" => ["support_print:read"]
    ]
)]

class SupportPrint
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({
     *      "postCommandeSupportPrint:write",
     *     "support_print:read"
     * })
     */
    private $quantite;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="supportPrint", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=TypePrint::class, inversedBy="supportPrints")
     * @Groups({
     *     "postCommandeSupportPrint:write",
     *     "getCommandesByClient:read",
     *     "support_print:read"
     * })
     */
    private $typePrint;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypePrint(): ?TypePrint
    {
        return $this->typePrint;
    }

    public function setTypePrint(?TypePrint $typePrint): self
    {
        $this->typePrint = $typePrint;

        return $this;
    }
}
