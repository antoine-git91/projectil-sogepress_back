<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"client:read"}},
 *     denormalizationContext={"groups"={"client:write"}}
 * )
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"client:read", "contact:read", "adresse:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"client:read", "client:write", "adresse:read", "commande:read"})
     */
    private $raison_sociale;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"client:read", "client:write"})
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"client:read", "client:write", "adresse:read", "commande:read"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"client:read", "client:write"})
     */
    private $site_internet;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"client:read", "client:write"})
     */
    private $type_facturation;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups("client:read")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("client:read")
     */
    private $modified_at;

    /**
     * @ORM\OneToMany(targetEntity=Adresse::class, mappedBy="client", fetch="LAZY")
     * @Groups({"client:read", "client:write"})
     */
    private $adresses;

    /**
     * @ORM\OneToMany(targetEntity=Contact::class, mappedBy="client")
     * @Groups({"client:read", "client:write"})
     */
    private $contacts;

    /**
     * @ORM\OneToMany(targetEntity=Potentialite::class, mappedBy="client")
     * @Groups({"client:read", "client:write"})
     */
    private $potentialites;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="client")
     * @Groups({"client:read", "client:write"})
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=HistoriqueClient::class, mappedBy="client")
     * @Groups({"client:read", "client:write"})
     */
    private $historiqueClients;

    /**
     * @ORM\OneToMany(targetEntity=Relance::class, mappedBy="client")
     * @Groups({"client:read", "client:write"})
     */
    private $relances;

    /**
     * @ORM\OneToOne(targetEntity=Magazine::class, mappedBy="client", cascade={"persist", "remove"})
     * @Groups({"client:read", "client:write"})
     */
    private $magazine;

    /**
     * @ORM\ManyToOne(targetEntity=NafSousClasses::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"client:read", "client:write"})
     */
    private $naf_sous_classe;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->potentialites = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->historiqueClients = new ArrayCollection();
        $this->relances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->raison_sociale;
    }

    public function setRaisonSociale(string $raison_sociale): self
    {
        $this->raison_sociale = $raison_sociale;

        return $this;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSiteInternet(): ?string
    {
        return $this->site_internet;
    }

    public function setSiteInternet(?string $site_internet): self
    {
        $this->site_internet = $site_internet;

        return $this;
    }

    public function getTypeFacturation(): ?bool
    {
        return $this->type_facturation;
    }

    public function setTypeFacturation(bool $type_facturation): self
    {
        $this->type_facturation = $type_facturation;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modified_at;
    }

    public function setModifiedAt(?\DateTimeInterface $modified_at): self
    {
        $this->modified_at = $modified_at;

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdresse(Adresse $adresse): self
    {
        if (!$this->adresses->contains($adresse)) {
            $this->adresses[] = $adresse;
            $adresse->setClient($this);
        }

        return $this;
    }

    public function removeAdresse(Adresse $adresse): self
    {
        if ($this->adresses->removeElement($adresse)) {
            // set the owning side to null (unless already changed)
            if ($adresse->getClient() === $this) {
                $adresse->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setClient($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getClient() === $this) {
                $contact->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Potentialite[]
     */
    public function getPotentialites(): Collection
    {
        return $this->potentialites;
    }

    public function addPotentialite(Potentialite $potentialite): self
    {
        if (!$this->potentialites->contains($potentialite)) {
            $this->potentialites[] = $potentialite;
            $potentialite->setClient($this);
        }

        return $this;
    }

    public function removePotentialite(Potentialite $potentialite): self
    {
        if ($this->potentialites->removeElement($potentialite)) {
            // set the owning side to null (unless already changed)
            if ($potentialite->getClient() === $this) {
                $potentialite->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

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
            $historiqueClient->setClient($this);
        }

        return $this;
    }

    public function removeHistoriqueClient(HistoriqueClient $historiqueClient): self
    {
        if ($this->historiqueClients->removeElement($historiqueClient)) {
            // set the owning side to null (unless already changed)
            if ($historiqueClient->getClient() === $this) {
                $historiqueClient->setClient(null);
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
            $relance->setClient($this);
        }

        return $this;
    }

    public function removeRelance(Relance $relance): self
    {
        if ($this->relances->removeElement($relance)) {
            // set the owning side to null (unless already changed)
            if ($relance->getClient() === $this) {
                $relance->setClient(null);
            }
        }

        return $this;
    }

    public function getMagazine(): ?Magazine
    {
        return $this->magazine;
    }

    public function setMagazine(Magazine $magazine): self
    {
        // set the owning side of the relation if necessary
        if ($magazine->getClient() !== $this) {
            $magazine->setClient($this);
        }

        $this->magazine = $magazine;

        return $this;
    }

    public function getNafSousClasse(): ?NafSousClasses
    {
        return $this->naf_sous_classe;
    }

    public function setNafSousClasse(?NafSousClasses $naf_sous_classe): self
    {
        $this->naf_sous_classe = $naf_sous_classe;

        return $this;
    }
}
