<?php

namespace App\Entity;

use App\Repository\EncartRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EncartRepository::class)
 */
class Encart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $emplacement;

    /**
     * @ORM\Column(type="boolean")
     */
    private $format;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="encart", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=SupportMagazine::class, inversedBy="encarts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $support_magazine;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmplacement(): ?bool
    {
        return $this->emplacement;
    }

    public function setEmplacement(bool $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getFormat(): ?bool
    {
        return $this->format;
    }

    public function setFormat(bool $format): self
    {
        $this->format = $format;

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

    public function getSupportMagazine(): ?SupportMagazine
    {
        return $this->support_magazine;
    }

    public function setSupportMagazine(?SupportMagazine $support_magazine): self
    {
        $this->support_magazine = $support_magazine;

        return $this;
    }
}
