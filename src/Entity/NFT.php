<?php

namespace App\Entity;

use App\Repository\NFTRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NFTRepository::class)]
class NFT
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $launch_date = null;

    #[ORM\Column]
    private ?float $launch_price_eur = null;

    #[ORM\Column]
    private ?float $launch_price_eth = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'nFTs')]
    private Collection $Category;

    #[ORM\OneToMany(mappedBy: 'nFT', targetEntity: NFTCollection::class)]
    private Collection $NFTCollection;

    public function __construct()
    {
        $this->Category = new ArrayCollection();
        $this->NFTCollection = new ArrayCollection();
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

    /**
     * @return Collection<int, NFTCollection>
     */
    public function getNFTCollection(): Collection
    {
        return $this->NFTCollection;
    }

    public function addNFTCollection(NFTCollection $nFTCollection): static
    {
        if (!$this->NFTCollection->contains($nFTCollection)) {
            $this->NFTCollection->add($nFTCollection);
            $nFTCollection->setNFT($this);
        }

        return $this;
    }

    public function removeNFTCollection(NFTCollection $nFTCollection): static
    {
        if ($this->NFTCollection->removeElement($nFTCollection)) {
            // set the owning side to null (unless already changed)
            if ($nFTCollection->getNFT() === $this) {
                $nFTCollection->setNFT(null);
            }
        }

        return $this;
    }
}
