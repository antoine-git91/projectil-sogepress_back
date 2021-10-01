<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 * @ApiResource(
 *     normalizationContext = {"groups"={"adresse:read"}},
 *     denormalizationContext = {"groups"={"adresse:write"}},
 *     collectionOperations = {"get", "post"},
 *     itemOperations = {"get", "put", "delete"}
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
     * @Groups({"adresse:read", "adresse:write"})
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255, name="type_voie")
     * @Groups({"adresse:read", "adresse:write"})
     */
    private $typeVoie;


    /**
     * @ORM\Column(type="string", length=255, name="nom_voie")
     * @Groups({"adresse:read", "adresse:write"})
     */
    private $nomVoie;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="adresses")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"adresse:read", "adresse:write"})
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="adresses")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"adresse:read", "adresse:write"})
     */
    private $client;

    /**
     * Facturation ou livraison
     * @ORM\Column(type="boolean", name="statut_adresse")
     * @Groups({"adresse:read", "adresse:write"})
     */
    private $statutAdresse;

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
        return $this->typeVoie;
    }

    public function setTypeVoie(string $typeVoie): self
    {
        $this->typeVoie = $typeVoie;

        return $this;
    }

    public function getNomVoie(): ?string
    {
        return $this->nomVoie;
    }

    public function setNomVoie(string $nomVoie): self
    {
        $this->nomVoie = $nomVoie;

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
        return $this->statutAdresse;
    }

    public function setStatutAdresse(bool $statutAdresse): self
    {
        $this->statutAdresse = $statutAdresse;

        return $this;
    }
}
