<?php

namespace App\Entity;

use App\Repository\SupportWebRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * @Groups("commande:read")
     */
    private $url;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("commande:read")
     */
    private $echeance_contrat;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="supportWeb", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=TypePrestationWeb::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups("commande:read")
     */
    private $type_prestation;

    /**
     * @ORM\ManyToOne(targetEntity=TypeSiteWeb::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups("commande:read")
     */
    private $type_site;

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

    public function getTypePrestation(): ?TypePrestationWeb
    {
        return $this->type_prestation;
    }

    public function setTypePrestation(?TypePrestationWeb $type_prestation): self
    {
        $this->type_prestation = $type_prestation;

        return $this;
    }

    public function getTypeSite(): ?TypeSiteWeb
    {
        return $this->type_site;
    }

    public function setTypeSite(?TypeSiteWeb $type_site): self
    {
        $this->type_site = $type_site;

        return $this;
    }
}
