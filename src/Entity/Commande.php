<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_COMMERCIAL')"},
 *     normalizationContext={"groups"={"commande:read"}},
 *     denormalizationContext={"groups"={"commande:write"}},
 *     collectionOperations = {"get", "post"},
 *     itemOperations = {"get", "put", "delete"}
 * )
 */
class Commande
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"commande:read", "client:read", "contact:read", "user:read", "relance:read", "historique:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"commande:read", "commande:write", "client:read", "contact:read"})
     */
    private $facturation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"commande:read", "commande:write", "client:read", "contact:read"})
     */
    private $reduction;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"commande:read", "commande:write", "client:read", "contact:read"})
     */
    private $debut;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"commande:read", "commande:write", "client:read", "contact:read"})
     */
    private $fin;

    /**
     * @ORM\Column(type="datetime_immutable", name="created_at")
     * @Groups({"commande:read", "commande:write"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="updated_at")
     * @Groups("commande:read")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="commandes", fetch="LAZY")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"commande:read", "commande:write"})
     */
    private $client;

    /**
     * @ORM\ManyToMany(targetEntity=Contact::class, inversedBy="commandes")
     * @Groups({"commande:read", "commande:write"})
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"commande:read", "commande:write", "client:read"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=HistoriqueClient::class, mappedBy="commande")
     * @Groups({"commande:read", "commande:write"})
     */
    private $historiqueClients;

    /**
     * @ORM\OneToMany(targetEntity=Relance::class, mappedBy="commande")
     * @Groups({"commande:read", "commande:write"})
     */
    private $relances;

    /**
     * @ORM\OneToOne(targetEntity=SupportWeb::class, mappedBy="commande", cascade={"persist", "remove"})
     * @Groups({"commande:read", "commande:write"})
     */
    private $supportWeb;

    /**
     * @ORM\OneToOne(targetEntity=SupportPrint::class, mappedBy="commande", cascade={"persist", "remove"})
     * @Groups({"commande:read", "commande:write"})
     */
    private $supportPrint;

    /**
     * @ORM\OneToOne(targetEntity=CommunityManagement::class, mappedBy="commande", cascade={"persist", "remove"})
     * @Groups({"commande:read", "commande:write"})
     */
    private $communityManagement;

    /**
     * @ORM\OneToOne(targetEntity=Contenu::class, mappedBy="commande", cascade={"persist", "remove"})
     * @Groups({"commande:read", "commande:write"})
     */
    private $contenu;

    /**
     * @ORM\OneToOne(targetEntity=Encart::class, mappedBy="commande", cascade={"persist", "remove"})
     * @Groups({"commande:read", "commande:write"})
     */
    private $encart;

    /**
     * @ORM\OneToOne(targetEntity=SupportMagazine::class, mappedBy="commande", cascade={"persist", "remove"})
     * @Groups({"commande:read", "commande:write"})
     */
    private $supportMagazine;

    /**
     * @ORM\ManyToOne(targetEntity=CommandeStatus::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"commande:read", "commande:write"})
     */
    private $statut;

    public function __construct()
    {
        $this->contact = new ArrayCollection();
        $this->historiqueClients = new ArrayCollection();
        $this->relances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFacturation(): ?int
    {
        return $this->facturation;
    }

    public function setFacturation(int $facturation): self
    {
        $this->facturation = $facturation;

        return $this;
    }

    public function getReduction(): ?int
    {
        return $this->reduction;
    }

    public function setReduction(?int $reduction): self
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(?\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(?\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contact->contains($contact)) {
            $this->contact[] = $contact;
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        $this->contact->removeElement($contact);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|HistoriqueClient[]
     */
    public function getHistoriqueClients(): Collection
    {
        return $this->historiqueClients;
    }

    public function addHistoriqueClient(HistoriqueClient $historiqueClient): self
    {
        if (!$this->historiqueClients->contains($historiqueClient)) {
            $this->historiqueClients[] = $historiqueClient;
            $historiqueClient->setCommande($this);
        }

        return $this;
    }

    public function removeHistoriqueClient(HistoriqueClient $historiqueClient): self
    {
        if ($this->historiqueClients->removeElement($historiqueClient)) {
            // set the owning side to null (unless already changed)
            if ($historiqueClient->getCommande() === $this) {
                $historiqueClient->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Relance[]
     */
    public function getRelances(): Collection
    {
        return $this->relances;
    }

    public function addRelance(Relance $relance): self
    {
        if (!$this->relances->contains($relance)) {
            $this->relances[] = $relance;
            $relance->setCommande($this);
        }

        return $this;
    }

    public function removeRelance(Relance $relance): self
    {
        if ($this->relances->removeElement($relance)) {
            // set the owning side to null (unless already changed)
            if ($relance->getCommande() === $this) {
                $relance->setCommande(null);
            }
        }

        return $this;
    }

    public function getSupportWeb(): ?SupportWeb
    {
        return $this->supportWeb;
    }

    public function setSupportWeb(SupportWeb $supportWeb): self
    {
        // set the owning side of the relation if necessary
        if ($supportWeb->getCommande() !== $this) {
            $supportWeb->setCommande($this);
        }

        $this->supportWeb = $supportWeb;

        return $this;
    }

    public function getSupportPrint(): ?SupportPrint
    {
        return $this->supportPrint;
    }

    public function setSupportPrint(SupportPrint $supportPrint): self
    {
        // set the owning side of the relation if necessary
        if ($supportPrint->getCommande() !== $this) {
            $supportPrint->setCommande($this);
        }

        $this->supportPrint = $supportPrint;

        return $this;
    }

    public function getCommunityManagement(): ?CommunityManagement
    {
        return $this->communityManagement;
    }

    public function setCommunityManagement(CommunityManagement $communityManagement): self
    {
        // set the owning side of the relation if necessary
        if ($communityManagement->getCommande() !== $this) {
            $communityManagement->setCommande($this);
        }

        $this->communityManagement = $communityManagement;

        return $this;
    }

    public function getContenu(): ?Contenu
    {
        return $this->contenu;
    }

    public function setContenu(Contenu $contenu): self
    {
        // set the owning side of the relation if necessary
        if ($contenu->getCommande() !== $this) {
            $contenu->setCommande($this);
        }

        $this->contenu = $contenu;

        return $this;
    }

    public function getEncart(): ?Encart
    {
        return $this->encart;
    }

    public function setEncart(Encart $encart): self
    {
        // set the owning side of the relation if necessary
        if ($encart->getCommande() !== $this) {
            $encart->setCommande($this);
        }

        $this->encart = $encart;

        return $this;
    }

    public function getSupportMagazine(): ?SupportMagazine
    {
        return $this->supportMagazine;
    }

    public function setSupportMagazine(SupportMagazine $supportMagazine): self
    {
        // set the owning side of the relation if necessary
        if ($supportMagazine->getCommande() !== $this) {
            $supportMagazine->setCommande($this);
        }

        $this->supportMagazine = $supportMagazine;

        return $this;
    }

    public function getStatut(): ?CommandeStatus
    {
        return $this->statut;
    }

    public function setStatut(?CommandeStatus $statut): self
    {
        $this->statut = $statut;

        return $this;
    }
}
