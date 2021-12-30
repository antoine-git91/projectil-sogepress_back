<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\ContactsByClientController;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ContactRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        "get",
        "getContactsByClient" => [
            'pagination_enabled' => false,
            'path' => '/contactsByClient/{client_id}',
            "controller" => ContactsByClientController::class,
            'method' => 'get',
            'read' => false,
            'openapi_context' => [
                'summary' => 'Récupère les contacts correspondantes au client',
                'parameters' => [
                    ['in' => 'path',
                        'name' => 'client_id',
                        'schema' => [
                            'type' => 'integer']
                    ]
                ]
            ],
            "normalization_context" => [ "groups" => "contactByClient:read"]
        ],
        "post"
    ],
    itemOperations: [
        "get",
        "put",
        "patch",
        "delete"
    ] ,
    attributes: [
        "security"=>"is_granted('ROLE_COMMERCIAL')"
    ],
    denormalizationContext: ["groups" => ["contact:write"]],
    normalizationContext: ["groups" => ["contact:read"]]
)]
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"contact:read", "historique:read", "client:read", "contactByClient:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"contact:read", "contact:write", "client:read", "client:write", "commande:read", "contactByClient:read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"contact:read", "contact:write", "client:read", "client:write", "commande:read", "contactByClient:read"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contact:read", "contact:write", "client:read", "client:write", "commande:read"})
     */
    private $fonction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contact:read", "contact:write", "client:read", "client:write", "commande:read"})
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Groups({"contact:read", "contact:write", "client:read", "client:write", "commande:read"})
     */
    private $tel;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"contact:read", "contact:write", "client:write"})
     */
    private $defaut;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Groups({"contact:read", "contact:write"})
     */
    private $client;

    /**
     * @ORM\ManyToMany(targetEntity=Commande::class, mappedBy="contact")
     * @Groups({"contact:read", "contact:write"})
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=HistoriqueClient::class, mappedBy="contact")
     * @Groups({"contact:read", "contact:write"})
     */
    private $historiqueClients;

    /**
     * @ORM\Column(type="datetime_immutable", name="created_at")
     * @Groups({"contact:read", "contact:write", "client:write"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="modified_at")
     * @Groups({"contact:read", "contact:write", "client:write"})
     */
    private $modifiedAt;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->historiqueClients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(?string $fonction): self
    {
        $this->fonction = $fonction;

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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getDefaut(): ?bool
    {
        return $this->defaut;
    }

    public function setDefaut(?bool $defaut): self
    {
        $this->defaut = $defaut;

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
            $commande->addContact($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeContact($this);
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
            $historiqueClient->setContact($this);
        }

        return $this;
    }

    public function removeHistoriqueClient(HistoriqueClient $historiqueClient): self
    {
        if ($this->historiqueClients->removeElement($historiqueClient)) {
            // set the owning side to null (unless already changed)
            if ($historiqueClient->getContact() === $this) {
                $historiqueClient->setContact(null);
            }
        }

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
}
