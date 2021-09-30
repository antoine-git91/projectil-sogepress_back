<?php

namespace App\Entity;

use App\Repository\ContenuRepository;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="boolean", name="type_contenu")
     */
    private $typeContenu;

    /**
     * @ORM\Column(type="integer")
     */
    private $feuillets;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="contenu", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeContenu(): ?bool
    {
        return $this->typeContenu;
    }

    public function setTypeContenu(bool $typeContenu): self
    {
        $this->typeContenu = $typeContenu;

        return $this;
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
}
