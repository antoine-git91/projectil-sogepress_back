<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"adresse:read"}},
 *     denormalizationContext={"groups"={"adresse:write"}}
 * )
 */
class Adresse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("adresse:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"adresse:read", "adresse:write", "client:read"})
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"adresse:read", "adresse:write", "client:read"})
     */
    private $type_voie;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"adresse:read", "adresse:write", "client:read"})
     */
    private $nom_voie;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="adresses")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"adresse:read", "adresse:write", "client:read"})
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="adresses", fetch="LAZY")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"adresse:read", "adresse:write"})
     */
    private $client;

    /**
     * Facturation ou livraison
     * @ORM\Column(type="boolean")
     * @Groups({"adresse:read", "adresse:write"})
     */
    private $statut_adresse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getTypeVoie(): ?string
    {
        return $this->type_voie;
    }

    public function setTypeVoie(string $type_voie): self
    {
        $this->type_voie = $type_voie;

        return $this;
    }

    public function getNomVoie(): ?string
    {
        return $this->nom_voie;
    }

    public function setNomVoie(string $nom_voie): self
    {
        $this->nom_voie = $nom_voie;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getStatutAdresse(): ?bool
    {
        return $this->statut_adresse;
    }

    public function setStatutAdresse(bool $statut_adresse): self
    {
        $this->statut_adresse = $statut_adresse;

        return $this;
    }
}
