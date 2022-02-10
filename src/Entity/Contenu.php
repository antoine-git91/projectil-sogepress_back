<?php

namespace App\Entity;

use App\Repository\ContenuRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ContenuRepository::class)
 */
class Contenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({
     *     "commande:read",
     *     "postCommandeContenu:write"
     * })
     */
    private $feuillets;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="contenu", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=TypeContenu::class, inversedBy="contenus")
     * @Groups({
     *     "commande:read",
     *     "postCommandeContenu:write",
     *     "getCommandesByClient:read"
     * })
     */
    private $typeContenu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeuillets(): ?int
    {
        return $this->feuillets;
    }

    public function setFeuillets(int $feuillets): self
    {
        $this->feuillets = $feuillets;

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

    public function getTypeContenu(): ?TypeContenu
    {
        return $this->typeContenu;
    }

    public function setTypeContenu(?TypeContenu $typeContenu): self
    {
        $this->typeContenu = $typeContenu;

        return $this;
    }
}
