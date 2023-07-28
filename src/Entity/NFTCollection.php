<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\NFTCollectionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NFTCollectionRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['collection:read','nft:read']])]
class NFTCollection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('nft:read')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('nft:read')]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'nFTCollection', targetEntity: NFT::class)]
    #[Groups('nft:read')]
    private ?Collection $nFT;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups('nft:read')]
    private ?string $description = null;

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

    /**
     * @return Collection<int, NFT>
     */
    public function getNfts(): Collection
    {
        return $this->nFT;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

}
