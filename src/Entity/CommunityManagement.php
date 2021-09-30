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
     * @ORM\Column(type="integer", name="post_mensuel")
     */
    private $postMensuel;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="communityManagement", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity=ReseauSocial::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $reseauSocial;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostMensuel(): ?int
    {
        return $this->postMensuel;
    }

    public function setPostMensuel(int $postMensuel): self
    {
        $this->postMensuel = $postMensuel;

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

    public function getReseauSocial(): ?ReseauSocial
    {
        return $this->reseauSocial;
    }

    public function setReseauSocial(?ReseauSocial $reseauSocial): self
    {
        $this->reseauSocial = $reseauSocial;

        return $this;
    }
}
