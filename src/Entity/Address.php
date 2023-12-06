<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: AddressRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['address:read','user:read']])]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:read','user:create'])]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:read','user:create'])]
    private ?string $ZIPCode = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:read','user:create'])]
    private ?string $street = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getZIPCode(): ?string
    {
        return $this->ZIPCode;
    }

    public function setZIPCode(string $ZIPCode): static
    {
        $this->ZIPCode = $ZIPCode;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }
}
