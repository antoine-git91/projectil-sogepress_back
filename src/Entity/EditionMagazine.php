<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\EditionsByMagazineController;
use App\Repository\EditionMagazineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EditionMagazineRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        "get",
        "getEditionsByMagazine" => [
            'pagination_enabled' => false,
            'path' => '/editionsByMagazine/{magazine_id}',
            "controller" => EditionsByMagazineController::class,
            'method' => 'get',
            'read' => false,
            'openapi_context' => [
                'summary' => 'Récupère les éditions correspondantes au magazine',
                'parameters' => [
                    ['in' => 'path',
                        'name' => 'magazine_id',
                        'schema' => [
                            'type' => 'integer']
                    ]
                ]
            ]
        ],
        ],
    itemOperations: ["get"]
)]
class EditionMagazine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"postCommandeSupportMagazine:write"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Magazine::class, inversedBy="editionMagazines")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"postCommandeSupportMagazine:write"})
     */
    private $magazine;

    /**
     * @ORM\OneToMany(targetEntity=Encart::class, mappedBy="editionMagazine")
     */
    private $encart;

    public function __construct()
    {
        $this->encarts = new ArrayCollection();
        $this->encart = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection|Encart[]
     */
    public function getEncart(): Collection
    {
        return $this->encart;
    }

    public function addEncart(Encart $encart): self
    {
        if (!$this->encart->contains($encart)) {
            $this->encart[] = $encart;
            $encart->setEditionMagazine($this);
        }

        return $this;
    }

    public function removeEncart(Encart $encart): self
    {
        if ($this->encart->removeElement($encart)) {
            // set the owning side to null (unless already changed)
            if ($encart->getEditionMagazine() === $this) {
                $encart->setEditionMagazine(null);
            }
        }

        return $this;
    }
}
