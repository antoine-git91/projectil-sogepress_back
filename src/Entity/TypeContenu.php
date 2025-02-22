<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypeContenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TypeContenuRepository::class)
 */
#[ApiResource(
    collectionOperations: ["get"],
    itemOperations: ["get"]
)]
class TypeContenu
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
     *     "commande:read",
     *     "getCommandesByClient:read",
     * })
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Contenu::class, mappedBy="typeContenu")
     */
    private $contenus;

    public function __construct()
    {
        $this->contenus = new ArrayCollection();
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
     * @return Collection|Contenu[]
     */
    public function getContenus(): Collection
    {
        return $this->contenus;
    }

    public function addContenu(Contenu $contenu): self
    {
        if (!$this->contenus->contains($contenu)) {
            $this->contenus[] = $contenu;
            $contenu->setTypeContenu($this);
        }

        return $this;
    }

    public function removeContenu(Contenu $contenu): self
    {
        if ($this->contenus->removeElement($contenu)) {
            // set the owning side to null (unless already changed)
            if ($contenu->getTypeContenu() === $this) {
                $contenu->setTypeContenu(null);
            }
        }

        return $this;
    }
}
