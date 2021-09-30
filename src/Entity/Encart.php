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
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="encart", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=SupportMagazine::class, inversedBy="encarts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $supportMagazine;

    /**
     * @ORM\ManyToOne(targetEntity=EmplacementMagazine::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $emplacement;

    /**
     * @ORM\ManyToOne(targetEntity=FormatEncart::class)
     * @ORM\JoinColumn(nullable=false)
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

    public function getSupportMagazine(): ?SupportMagazine
    {
        return $this->supportMagazine;
    }

    public function setSupportMagazine(?SupportMagazine $supportMagazine): self
    {
        $this->supportMagazine = $supportMagazine;

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
