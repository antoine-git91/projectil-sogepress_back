<?php

namespace App\Entity;

use App\Repository\CommunityManagementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommunityManagementRepository::class)
 */
class CommunityManagement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reseau_social;

    /**
     * @ORM\Column(type="integer")
     */
    private $post_mensuel;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="communityManagement", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReseauSocial(): ?bool
    {
        return $this->reseau_social;
    }

    public function setReseauSocial(bool $reseau_social): self
    {
        $this->reseau_social = $reseau_social;

        return $this;
    }

    public function getPostMensuel(): ?int
    {
        return $this->post_mensuel;
    }

    public function setPostMensuel(int $post_mensuel): self
    {
        $this->post_mensuel = $post_mensuel;

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
