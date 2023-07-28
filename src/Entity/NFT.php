<?php

namespace App\Entity;

use App\Repository\NFTRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NFTRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['nft:read','user:read']])]
class NFT
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('nft:read')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('nft:read')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups('nft:read')]
    private ?string $img = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups('nft:read')]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups('nft:read')]
    private ?\DateTimeInterface $launch_date = null;

    #[ORM\Column]
    #[Groups('nft:read')]
    private ?float $launch_price_eur = null;

    #[ORM\Column]
    #[Groups('nft:read')]
    private ?float $launch_price_eth = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'nFTs')]
    #[Groups('nft:read','collection:read')]
    private Collection $Category;

    #[ORM\ManyToOne(targetEntity: NFTCollection::class, inversedBy: 'nFT')]
    #[ORM\JoinColumn(name: 'nft_collection_id', referencedColumnName: 'id', nullable: false)]
    #[Groups('nft:read','collection:read')]
    private NFTCollection $nFTCollection;

    #[ORM\ManyToOne(inversedBy: 'nft')]
    #[Groups('nft:read')]
    private ?User $user = null;

    public function __construct()
    {
        $this->Category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLaunchDate(): ?\DateTimeInterface
    {
        return $this->launch_date;
    }

    public function setLaunchDate(\DateTimeInterface $launch_date): static
    {
        $this->launch_date = $launch_date;

        return $this;
    }

    public function getLaunchPriceEur(): ?float
    {
        return $this->launch_price_eur;
    }

    public function setLaunchPriceEur(float $launch_price_eur): static
    {
        $this->launch_price_eur = $launch_price_eur;

        return $this;
    }

    public function getLaunchPriceEth(): ?float
    {
        return $this->launch_price_eth;
    }

    public function setLaunchPriceEth(float $launch_price_eth): static
    {
        $this->launch_price_eth = $launch_price_eth;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->Category;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->Category->contains($category)) {
            $this->Category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->Category->removeElement($category);

        return $this;
    }

    public function getNFTCollection(): NFTCollection
    {
        return $this->nFTCollection;
    }

    public function setNFTCollection(NFTCollection $nFTCollection): self
    {
        $this->nFTCollection = $nFTCollection;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

}
