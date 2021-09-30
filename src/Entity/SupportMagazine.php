<?php

namespace App\Entity;

use App\Repository\SupportMagazineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SupportMagazineRepository::class)
 */
class SupportMagazine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"magazine:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $pages;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $edition;

    /**
     * @ORM\Column(type="date", name="fin_commercialisation")
     */
    private $finCommercialisation;

    /**
     * @ORM\OneToMany(targetEntity=Magazine::class, mappedBy="supportMagazine")
     */
    private $magazine;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="supportMagazine", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\OneToMany(targetEntity=Encart::class, mappedBy="support_magazine")
     */
    private $encarts;

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

    public function getEdition(): ?string
    {
        return $this->edition;
    }

    public function setEdition(string $edition): self
    {
        $this->edition = $edition;

        return $this;
    }

    public function getFinCommercialisation(): ?\DateTimeInterface
    {
        return $this->finCommercialisation;
    }

    public function setFinCommercialisation(\DateTimeInterface $finCommercialisation): self
    {
        $this->finCommercialisation = $finCommercialisation;

        return $this;
    }

    /**
     * @return Collection|Magazine[]
     */
    public function getMagazine(): Collection
    {
        return $this->magazine;
    }

    public function addMagazine(Magazine $magazine): self
    {
        if (!$this->magazine->contains($magazine)) {
            $this->magazine[] = $magazine;
            $magazine->setSupportMagazine($this);
        }

        return $this;
    }

    public function removeMagazine(Magazine $magazine): self
    {
        if ($this->magazine->removeElement($magazine)) {
            // set the owning side to null (unless already changed)
            if ($magazine->getSupportMagazine() === $this) {
                $magazine->setSupportMagazine(null);
            }
        }

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
}
