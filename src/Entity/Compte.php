<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteRepository::class)]
class Compte
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $numC = null;

    #[ORM\Column]
    private ?int $solde = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\ManyToOne(inversedBy: 'comptes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    public function getNumC(): ?int
    {
        return $this->numC;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setNumC(int $numC): static
    {
        $this->numC = $numC;

        return $this;
    }

    public function setSolde(int $solde): static
    {
        $this->solde = $solde;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }
}
