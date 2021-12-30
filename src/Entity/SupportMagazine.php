<?php

namespace App\Entity;

use App\Controller\EditionsByMagazineController;
use App\Repository\SupportMagazineRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SupportMagazineRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        "get",
        "post"
    ],
    itemOperations: [
        "get"
    ],
    attributes: [
        "security" => "is_granted('ROLE_COMMERCIAL')"
    ]
)]
class SupportMagazine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"postCommandeSupportMagazine:write"})
     */
    private $pages;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"postCommandeSupportMagazine:write"})
     */
    private $quantite;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="supportMagazine")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\OneToMany(targetEntity=Encart::class, mappedBy="supportMagazine")
     */
    private $encarts;

    /**
     * @ORM\OneToOne(targetEntity=EditionMagazine::class, cascade={"persist", "remove"})
     * @Groups({"postCommandeSupportMagazine:write"})
     */
    private $edition;

    public function __construct()
    {
        $this->magazine = new ArrayCollection();
        $this->encarts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPages(): ?int
    {
        return $this->pages;
    }

    public function setPages(int $pages): self
    {
        $this->pages = $pages;

        return $this;
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

    /**
     * @return Collection|Encart[]
     */
    public function getEncarts(): Collection
    {
        return $this->encarts;
    }

    public function addEncart(Encart $encart): self
    {
        if (!$this->encarts->contains($encart)) {
            $this->encarts[] = $encart;
            $encart->setSupportMagazine($this);
        }

        return $this;
    }

    public function removeEncart(Encart $encart): self
    {
        if ($this->encarts->removeElement($encart)) {
            // set the owning side to null (unless already changed)
            if ($encart->getSupportMagazine() === $this) {
                $encart->setSupportMagazine(null);
            }
        }

        return $this;
    }

    public function getEdition(): ?EditionMagazine
    {
        return $this->edition;
    }

    public function setEdition(?EditionMagazine $edition): self
    {
        $this->edition = $edition;

        return $this;
    }
}
