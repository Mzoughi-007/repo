<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column]
    private ?int $nbbooks = null;

    #[ORM\Column(length: 100)]
    private ?string $emailaddress = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getNbbooks(): ?int
    {
        return $this->nbbooks;
    }

    public function setNbbooks(int $nbbooks): static
    {
        $this->nbbooks = $nbbooks;

        return $this;
    }

    public function getEmailaddress(): ?string
    {
        return $this->emailaddress;
    }

    public function setEmailaddress(string $emailaddress): static
    {
        $this->emailaddress = $emailaddress;

        return $this;
    }
}
