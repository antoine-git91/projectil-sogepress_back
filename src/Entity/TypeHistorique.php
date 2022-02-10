<?php

namespace App\Entity;

use App\Repository\TypeHistoriqueRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TypeHistoriqueRepository::class)
 * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_COMMERCIAL')"},
 *     collectionOperations = {"get"},
 *     itemOperations = {"get"}
 * )
 */
class TypeHistorique
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"historique:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "client:read",
     *     "commande:read",
     *     "historique:read",
     *     "getHistoriquesByClient:read"
     * })
     */
    private $libelle;

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
}
