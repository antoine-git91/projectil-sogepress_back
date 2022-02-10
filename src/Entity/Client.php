<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\GetNumberClientCurrentMonthByUserController;
use App\Controller\GetPotentialCustomersController;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        "get" =>[
        "pagination_items_per_page" => 20,
        ],
        "getNumberClientCurrentMonthByUser" => [
            "pagination_enabled" => false,
            "method" => "get",
            "controller" => GetNumberClientCurrentMonthByUserController::class,
            "path" => '/getNumberClientCurrentMonth/{id_user}',
            'read' => false,
            'openapi_context' => [
                'summary' => 'Récupère les commandes correspondantes au user connecté',
                'parameters' => [
                    ['in' => 'path',
                        'name' => 'id_user',
                        'schema' => [
                            'type' => 'integer']
                    ]
                ]
            ]
        ],
        "post"
    ],
    itemOperations: [
        "get",
        "put",
        "patch",
        "delete"
    ],
    attributes: [
        "security"=>"is_granted('ROLE_COMMERCIAL')"
    ],
    denormalizationContext: ["groups" => ["client:write"]],
    normalizationContext: ["groups" => ["client:read"]]
)]

class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({
     *     "client:read",
     *     "contact:read",
     *     "adresse:read",
     *     "relance:read",
     *     "potentialite:read",
     *     "magazine:read",
     *     "historique:read",
     *     "relance:read",
     *     "magazine:read",
     *     "getPotentialCustomers:read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, name="raison_sociale")
     * @Groups({
     *     "client:read",
     *     "client:write",
     *     "adresse:read",
     *     "commandes:read",
     *     "magazine:read",
     *     "relance:read",
     *     "getRelancesByUser:read",
     *     "getRelancesByCommande:read",
     *     "getRelancesByCommande:read",
     *     "getRelancesByClient:read",
     *     "getPotentialCustomers:read"
     * })
     */
    private $raisonSociale;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({
     *     "client:read",
     *     "client:write",
     * })
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *     "client:read",
     *     "client:write",
     *     "adresse:read",
     *     "relance:read",
     *     "getPotentialCustomers:read"
     * })
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="site_internet")
     * @Groups({
     *     "client:read",
     *     "client:write"
     * })
     */
    private $siteInternet;

    /**
     * @ORM\Column(type="boolean", name="type_facturation")
     * @Groups({
     *     "client:read",
     *     "client:write"
     * })
     */
    private $typeFacturation;

    /**
     * @ORM\Column(type="datetime_immutable", name="created_at")
     * @Groups({
     *     "client:read",
     *     "client:write"
     * })
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="modified_at")
     * @Groups({
     *     "client:read"
     * })
     */
    private $modifiedAt;

    /**
     * @ORM\OneToMany(targetEntity=Adresse::class, mappedBy="client",cascade={"persist"}, fetch="LAZY", orphanRemoval=true)
     * @Groups({
     *     "client:read",
     *     "client:write",
     *     "getPotentialCustomers:read"
     * })
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Contact::class, mappedBy="client", cascade={"persist"}, orphanRemoval=true)
     * @Groups({
     *     "client:read",
     *     "client:write"
     * })
     * @Assert\Valid
     */
    private Collection $contacts;

    /**
     * @ORM\OneToMany(targetEntity=Potentialite::class, mappedBy="client", cascade={"persist"}, orphanRemoval=true)
     * @Groups({
     *     "client:read",
     *     "client:write"
     * })
     */
    private $potentialites;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="client")
     * @Groups({
     *     "client:read",
     *     "client:write"
     * })
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=HistoriqueClient::class, mappedBy="client", orphanRemoval=true)
     * @Groups({
     *     "client:read"
     * })
     */
    private Collection $historiqueClients;

    /**
     * @ORM\OneToMany(targetEntity=Relance::class, mappedBy="client")
     */
    private $relances;

    /**
     * @ORM\ManyToOne(targetEntity=NafSousClasses::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({
     *     "client:read",
     *     "client:write",
     * })
     */
    private $nafSousClasse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({
     *     "client:read",
     *     "client:write",
     *     "getPotentialCustomers:read"
     * })
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity=Magazine::class, mappedBy="client")
     * @Groups({
     *     "client:write",
     * })
     */
    private $magazine;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="client")
     * @Groups({
     *     "client:read",
     *     "client:write",
     * })
     */
    private $user;

    public function __construct()
    {
        $this->adresse = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->potentialites = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->historiqueClients = new ArrayCollection();
        $this->relances = new ArrayCollection();
        $this->magazine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->raisonSociale;
    }

    public function setRaisonSociale(string $raisonSociale): self
    {
        $this->raisonSociale = $raisonSociale;

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
        return $this->siteInternet;
    }

    public function setSiteInternet(?string $siteInternet): self
    {
        $this->siteInternet = $siteInternet;

        return $this;
    }

    public function getTypeFacturation(): ?bool
    {
        return $this->typeFacturation;
    }

    public function setTypeFacturation(bool $typeFacturation): self
    {
        $this->typeFacturation = $typeFacturation;

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

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresse(): Collection
    {
        return $this->adresse;
    }

    public function addAdresse(Adresse $adresse): self
    {
        if (!$this->adresse->contains($adresse)) {
            $this->adresse[] = $adresse;
            $adresse->setClient($this);
        }

        return $this;
    }

    public function removeAdresse(Adresse $adresse): self
    {
        if ($this->adresse->removeElement($adresse)) {
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

    public function getNafSousClasse(): ?NafSousClasses
    {
        return $this->nafSousClasse;
    }

    public function setNafSousClasse(?NafSousClasses $nafSousClasse): self
    {
        $this->nafSousClasse = $nafSousClasse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection|Magazine[]
     */
    public function getMagazine(): Collection
    {
        return $this->magazine;
    }

    public function addMagazine(Magazine $magazine): self
    {
        if (!$this->magazine->contains($magazine)) {
            $this->magazine[] = $magazine;
            $magazine->setClient($this);
        }

        return $this;
    }

    public function removeMagazine(Magazine $magazine): self
    {
        if ($this->magazine->removeElement($magazine)) {
            // set the owning side to null (unless already changed)
            if ($magazine->getClient() === $this) {
                $magazine->setClient(null);
            }
        }

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
}
