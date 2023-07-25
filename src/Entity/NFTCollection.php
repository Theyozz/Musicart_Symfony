<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\NFTCollectionRepository;
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

    #[ORM\ManyToOne(inversedBy: 'NFTCollection')]
    private ?NFT $nFT = null;

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

    public function getNFT(): ?NFT
    {
        return $this->nFT;
    }

    public function setNFT(?NFT $nFT): static
    {
        $this->nFT = $nFT;

        return $this;
    }
}
