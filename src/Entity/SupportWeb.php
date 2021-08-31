<?php

namespace App\Entity;

use App\Repository\SupportWebRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SupportWebRepository::class)
 */
class SupportWeb
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
    private $type_prestation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $type_site;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $echeance_contrat;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="supportWeb", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypePrestation(): ?bool
    {
        return $this->type_prestation;
    }

    public function setTypePrestation(bool $type_prestation): self
    {
        $this->type_prestation = $type_prestation;

        return $this;
    }

    public function getTypeSite(): ?bool
    {
        return $this->type_site;
    }

    public function setTypeSite(?bool $type_site): self
    {
        $this->type_site = $type_site;

        return $this;
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

    public function getEcheanceContrat(): ?\DateTimeInterface
    {
        return $this->echeance_contrat;
    }

    public function setEcheanceContrat(?\DateTimeInterface $echeance_contrat): self
    {
        $this->echeance_contrat = $echeance_contrat;

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
