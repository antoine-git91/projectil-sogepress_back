<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use App\Controller\VillesByCPController;
use App\Repository\VilleRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        "get" => [
        ],
        "getByCP" => [
            'pagination_enabled' => false,
            'path' => '/villesByCp/{code_postal}',
            "controller" => VillesByCPController::class,
            'method' => 'get',
            'read' => false,
            'openapi_context' => [
                'summary' => 'Récupère les villes correspondantes au code postal',
                'parameters' => [
                    ['in' => 'path',
                    'name' => 'code_postal',
                    'schema' => [
                        'type' => 'integer']
                    ]
                ]
            ]
        ]
    ],
    itemOperations: ["get"],
    attributes: [
        "security"=>"is_granted('ROLE_COMMERCIAL')"
    ]
)]

class Ville
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "ville:read",
     *     "adresse:read",
     *     "client:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"
     *   ville:read",
     *   "adresse:read",
     *   "client:read",
     *   "commande:read",
     *   "getPotentialCustomers:read"
     * })
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=5, name="code_postal")
     * @Groups({
     *     "ville:read",
     *     "adresse:read",
     *     "client:read",
     *     "commande:read",
     *     "getPotentialCustomers:read"
     * })
     */
    private $codePostal;

    /**
     * @ORM\OneToMany(targetEntity=Adresse::class, mappedBy="ville")
     */
    private $adresses;

    /**
     * @ORM\Column(type="float")
     * @Groups({"ville:read", "adresse:read"})
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     * @Groups({"ville:read", "adresse:read"})
     */
    private $longitude;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adresse): self
    {
        if (!$this->adresses->contains($adresse)) {
            $this->adresses[] = $adresse;
            $adresse->setVille($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adresse): self
    {
        if ($this->adresses->removeElement($adresse)) {
            // set the owning side to null (unless already changed)
            if ($adresse->getVille() === $this) {
                $adresse->setVille(null);
            }
        }

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }
}
