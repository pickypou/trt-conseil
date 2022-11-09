<?php

namespace App\Entity;

use App\Repository\AnnoncesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnoncesRepository::class)]
class Annonces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $job = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?User $annonce = null;

    #[ORM\Column(length: 255)]
    private ?string $salaire = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?Recruteurs $recruteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAnnonce(): ?User
    {
        return $this->annonce;
    }

    public function setAnnonce(?User $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }

    public function getSalaire(): ?string
    {
        return $this->salaire;
    }

    public function setSalaire(string $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getRecruteur(): ?Recruteurs
    {
        return $this->recruteur;
    }

    public function setRecruteur(?Recruteurs $recruteur): self
    {
        $this->recruteur = $recruteur;

        return $this;
    }
}
