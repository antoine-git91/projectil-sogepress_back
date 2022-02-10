<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypePrintRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TypePrintRepository::class)
 */
#[ApiResource(
    collectionOperations: ["get"],
    itemOperations: ["get"]
)]
class TypePrint
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ({
     *      "getCommandesByClient:read",
     *     "support_print:read"
     * })
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=SupportPrint::class, mappedBy="type_print")
     */
    private $supportPrints;

    public function __construct()
    {
        $this->supportPrints = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|SupportPrint[]
     */
    public function getSupportPrints(): Collection
    {
        return $this->supportPrints;
    }

    public function addSupportPrint(SupportPrint $supportPrint): self
    {
        if (!$this->supportPrints->contains($supportPrint)) {
            $this->supportPrints[] = $supportPrint;
            $supportPrint->setTypePrint($this);
        }

        return $this;
    }

    public function removeSupportPrint(SupportPrint $supportPrint): self
    {
        if ($this->supportPrints->removeElement($supportPrint)) {
            // set the owning side to null (unless already changed)
            if ($supportPrint->getTypePrint() === $this) {
                $supportPrint->setTypePrint(null);
            }
        }

        return $this;
    }
}
