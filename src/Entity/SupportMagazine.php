<?php

namespace App\Entity;

use App\Repository\SupportMagazineRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SupportMagazineRepository::class)
 * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_COMMERCIAL')"},
 *     normalizationContext={"groups"={"support_magazine:read"}},
 *     denormalizationContext={"groups"={"support_magazine:write"}},
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class SupportMagazine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"support_magazine:read", "commande:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"support_magazine:read"})
     */
    private $pages;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"support_magazine:read"})
     */
    private $quantite;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"support_magazine:read"})
     */
    private $edition;

    /**
     * @ORM\Column(type="date", name="fin_commercialisation")
     * @Groups({"support_magazine:read"})
     */
    private $finCommercialisation;

    /**
     * @ORM\ManyToOne(targetEntity=Magazine::class, inversedBy="supportMagazine")
     * @Groups({"support_magazine:read"})
     */
    private $magazine;


    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="supportMagazine")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"support_magazine:read"})
     */
    private $commande;

    /**
     * @ORM\OneToMany(targetEntity=Encart::class, mappedBy="supportMagazine")
     * @Groups({"support_magazine:read"})
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

    public function getMagazine(): ?Magazine
    {
        return $this->magazine;
    }


    public function setMagazine(?Magazine $magazine): self
    {
        $this->magazine = $magazine;

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
