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
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="date", nullable=true, name="echeance_contrat")
     */
    private $echeanceContrat;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="supportWeb", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=TypePrestationWeb::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $typePrestation;

    /**
     * @ORM\ManyToOne(targetEntity=TypeSiteWeb::class)
     * @ORM\JoinColumn(nullable=false)
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

    public function getEcheanceContrat(): ?\DateTimeInterface
    {
        return $this->echeanceContrat;
    }

    public function setEcheanceContrat(?\DateTimeInterface $echeanceContrat): self
    {
        $this->echeanceContrat = $echeanceContrat;

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
