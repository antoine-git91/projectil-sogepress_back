<?php

namespace App\Entity;

use App\Repository\SupportPrintRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SupportPrintRepository::class)
 */
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
     * @Groups("commande:read")
     */
    private $quantite;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="supportPrint", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

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
}
