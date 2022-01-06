<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EncartRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EncartRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        "get",
        "post"
    ],
    itemOperations: ["get"]
)]
class Encart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"commande:read"})
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="encart", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=EmplacementMagazine::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"commande:read", "postCommandeEncart:write"})
     */
    private $emplacement;

    /**
     * @ORM\ManyToOne(targetEntity=FormatEncart::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"commande:read", "postCommandeEncart:write"})
     */
    private $format;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmplacement(): ?EmplacementMagazine
    {
        return $this->emplacement;
    }

    public function setEmplacement(?EmplacementMagazine $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getFormat(): ?FormatEncart
    {
        return $this->format;
    }

    public function setFormat(?FormatEncart $format): self
    {
        $this->format = $format;

        return $this;
    }
}
