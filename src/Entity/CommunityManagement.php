<?php

namespace App\Entity;

use App\Repository\CommunityManagementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * @Groups({
     *     "commande:read",
     *     "postCommandeCommunity:write"
     * })
     */
    private $postMensuel;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, inversedBy="communityManagement", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $commande;

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
}
