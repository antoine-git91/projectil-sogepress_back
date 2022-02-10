<?php

namespace App\Entity;

use App\Controller\LoggedInController;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
#[ApiResource(
    collectionOperations: [
        "get",
        "post",
        "loggedIn" => [
            'pagination_enabled' => false,
            'path' => '/loggedin',
            'method' => 'get',
            'controller' => LoggedInController::class,
            'read'=> false
        ]
    ],
    itemOperations: [
        "get",
        "patch",
        "delete"
    ],
    attributes: [
    "security"=>"is_granted('ROLE_COMMERCIAL')"
    ],
    denormalizationContext: ['groups' => 'user:write'],
    normalizationContext: ['groups' => 'user:read']
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups([
        "user:read",
        "historique:read"
    ])]
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    #[Groups(["user:read", "user:write"])]
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    #[Groups(["user:read", "user:write"])]
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string
     * @Assert\Length(min="8", max="22") // Apply validation here, not on $password
     */
    #[Groups("user:write")] // Expose using groups
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["user:read","user:write", "client:read", "commande:read"])]
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["user:read","user:write", "client:read", "commande:read"])]
    private $prenom;

    /**
     * @ORM\Column(type="datetime_immutable", name="created_at")
     */
    #[Groups(["user:read","user:write"])]
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="logged_at")
     */
    #[Groups("user:read")]
    private $loggedAt;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="user")
     */
    #[Groups(["user:read","user:write"])]
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=HistoriqueClient::class, mappedBy="user")
     */
    #[Groups(["user:read","user:write"])]
    private $historiqueClients;

    /**
     * @ORM\Column(type="string", length=10)
     */
    #[Groups(["user:read","user:write"])]
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="user")
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity=Relance::class, mappedBy="user")
     */
    private $relance;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->historiqueClients = new ArrayCollection();
        $this->client = new ArrayCollection();
        $this->relance = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getLoggedAt(): ?\DateTimeInterface
    {
        return $this->loggedAt;
    }

    public function setLoggedAt(?\DateTimeInterface $loggedAt): self
    {
        $this->loggedAt = $loggedAt;

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
            $commande->setUser($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getUser() === $this) {
                $commande->setUser(null);
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
            $historiqueClient->setUser($this);
        }

        return $this;
    }

    public function removeHistoriqueClient(HistoriqueClient $historiqueClient): self
    {
        if ($this->historiqueClients->removeElement($historiqueClient)) {
            // set the owning side to null (unless already changed)
            if ($historiqueClient->getUser() === $this) {
                $historiqueClient->setUser(null);
            }
        }

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(Client $client): self
    {
        if (!$this->client->contains($client)) {
            $this->client[] = $client;
            $client->setUser($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getUser() === $this) {
                $client->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Relance[]
     */
    public function getRelance(): Collection
    {
        return $this->relance;
    }

    public function addRelance(Relance $relance): self
    {
        if (!$this->relance->contains($relance)) {
            $this->relance[] = $relance;
            $relance->setUser($this);
        }

        return $this;
    }

    public function removeRelance(Relance $relance): self
    {
        if ($this->relance->removeElement($relance)) {
            // set the owning side to null (unless already changed)
            if ($relance->getUser() === $this) {
                $relance->setUser(null);
            }
        }

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
}
