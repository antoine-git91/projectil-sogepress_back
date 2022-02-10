<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RelanceStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RelanceStatusRepository::class)
 */
#[ApiResource]
class RelanceStatus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "relance:read",
     *     "getRelancesByUser:read",
     *     "getRelancesByCommande:read",
     *     "getRelancesByClient:read"
     * })
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Relance::class, mappedBy="status")
     */
    private $relances;

    public function __construct()
    {
        $this->relances = new ArrayCollection();
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

    /**
     * @return Collection|Relance[]
     */
    public function getRelances(): Collection
    {
        return $this->relances;
    }

    public function addRelance(Relance $relance): self
    {
        if (!$this->relances->contains($relance)) {
            $this->relances[] = $relance;
            $relance->setStatus($this);
        }

        return $this;
    }

    public function removeRelance(Relance $relance): self
    {
        if ($this->relances->removeElement($relance)) {
            // set the owning side to null (unless already changed)
            if ($relance->getStatus() === $this) {
                $relance->setStatus(null);
            }
        }

        return $this;
    }
}
