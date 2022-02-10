<?php

namespace App\Entity;

use App\Repository\FormatEncartRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormatEncartRepository::class)
 *  * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_COMMERCIAL')"},
 *     collectionOperations = {"get"},
 *     itemOperations = {"get"}
 * )
 */
class FormatEncart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "encart:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "encart:read"
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
