<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['user:read', 'nft:read']])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('user:read', 'nft:read')]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups('user:read', 'nft:read')]
    private ?string $pseudo = null;

    #[ORM\Column]
    #[Groups('user:read')]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups('user:read')]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups('user:read')]
    private ?bool $gender = null;

    #[ORM\Column(length: 255)]
    #[Groups('user:read')]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Groups('user:read')]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups('user:read')]
    private ?\DateTimeInterface $BirthDate = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups('user:read')]
    private ?Address $Address = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: NFT::class)]
    private Collection $nft;

    #[ORM\Column(length: 255)]
    #[Groups('user:read', 'nft:read')]
    private ?string $profil_picture = null;

    public function __construct()
    {
        $this->nft = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->pseudo;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->pseudo;
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

    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

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
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function isGender(): ?bool
    {
        return $this->gender;
    }

    public function setGender(bool $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->BirthDate;
    }

    public function setBirthDate(\DateTimeInterface $BirthDate): static
    {
        $this->BirthDate = $BirthDate;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->Address;
    }

    public function setAddress(?Address $Address): static
    {
        $this->Address = $Address;

        return $this;
    }

    /**
     * @return Collection<int, NFT>
     */
    public function getNft(): Collection
    {
        return $this->nft;
    }

    public function addNft(NFT $nft): static
    {
        if (!$this->nft->contains($nft)) {
            $this->nft->add($nft);
            $nft->setUser($this);
        }

        return $this;
    }

    public function removeNft(NFT $nft): static
    {
        if ($this->nft->removeElement($nft)) {
            // set the owning side to null (unless already changed)
            if ($nft->getUser() === $this) {
                $nft->setUser(null);
            }
        }

        return $this;
    }

    public function getProfilPicture(): ?string
    {
        return $this->profil_picture;
    }

    public function setProfilPicture(string $profil_picture): static
    {
        $this->profil_picture = $profil_picture;

        return $this;
    }
}
