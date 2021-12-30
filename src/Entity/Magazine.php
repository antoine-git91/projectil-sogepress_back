<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\MagazineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MagazineRepository::class)
 * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_COMMERCIAL')"},
 *     normalizationContext={"groups"={"magazine:read"}},
 *     denormalizationContext={"groups"={"magazine:write"}},
 *     collectionOperations = {"get", "post"},
 *     itemOperations = {"get", "put", "delete"}
 * )
 */
class Magazine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"magazine:read", "client:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"magazine:read","magazine:write", "client:read"})
     */
    private $nom;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, inversedBy="magazine", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Groups({"magazine:read","magazine:write"})
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity=Potentialite::class, mappedBy="magazine", cascade={"persist"}, orphanRemoval=true)
     * @Groups({"magazine:read","magazine:write"})
     * @Assert\Valid
     */
    private $potentialites;

    /**
     * @ORM\OneToMany(targetEntity=EditionMagazine::class, mappedBy="magazine", orphanRemoval=true)
     */
    private $editionMagazines;

    public function __construct()
    {
        $this->potentialites = new ArrayCollection();
        $this->editionMagazines = new ArrayCollection();
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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|Potentialite[]
     */
    public function getPotentialites(): Collection
    {
        return $this->potentialites;
    }

    public function addPotentialite(Potentialite $potentialite): self
    {
        if (!$this->potentialites->contains($potentialite)) {
            $this->potentialites[] = $potentialite;
            $potentialite->setMagazine($this);
        }

        return $this;
    }

    public function removePotentialite(Potentialite $potentialite): self
    {
        if ($this->potentialites->removeElement($potentialite)) {
            // set the owning side to null (unless already changed)
            if ($potentialite->getMagazine() === $this) {
                $potentialite->setMagazine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EditionMagazine[]
     */
    public function getEditionMagazines(): Collection
    {
        return $this->editionMagazines;
    }

    public function addEditionMagazine(EditionMagazine $editionMagazine): self
    {
        if (!$this->editionMagazines->contains($editionMagazine)) {
            $this->editionMagazines[] = $editionMagazine;
            $editionMagazine->setMagazine($this);
        }

        return $this;
    }

    public function removeEditionMagazine(EditionMagazine $editionMagazine): self
    {
        if ($this->editionMagazines->removeElement($editionMagazine)) {
            // set the owning side to null (unless already changed)
            if ($editionMagazine->getMagazine() === $this) {
                $editionMagazine->setMagazine(null);
            }
        }

        return $this;
    }
}
