<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MagazineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MagazineRepository::class)
 */
class Magazine
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
    private $nom;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, inversedBy="magazine", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=SupportMagazine::class, inversedBy="magazine")
     */
    private $supportMagazine;

    /**
     * @ORM\OneToMany(targetEntity=Potentialites::class, mappedBy="magazine")
     */
    private $potentialites;

    public function __construct()
    {
        $this->potentialites = new ArrayCollection();
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

    public function getSupportMagazine(): ?SupportMagazine
    {
        return $this->supportMagazine;
    }

    public function setSupportMagazine(?SupportMagazine $supportMagazine): self
    {
        $this->supportMagazine = $supportMagazine;

        return $this;
    }

    /**
     * @return Collection|Potentialites[]
     */
    public function getPotentialites(): Collection
    {
        return $this->potentialites;
    }

    public function addPotentialite(Potentialites $potentialite): self
    {
        if (!$this->potentialites->contains($potentialite)) {
            $this->potentialites[] = $potentialite;
            $potentialite->setMagazine($this);
        }

        return $this;
    }

    public function removePotentialite(Potentialites $potentialite): self
    {
        if ($this->potentialites->removeElement($potentialite)) {
            // set the owning side to null (unless already changed)
            if ($potentialite->getMagazine() === $this) {
                $potentialite->setMagazine(null);
            }
        }

        return $this;
    }
}
