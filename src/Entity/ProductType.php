<?php

namespace App\Entity;

use App\Repository\ProductTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductTypeRepository::class)]
class ProductType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $electromenager = null;

    #[ORM\Column(length: 255)]
    private ?string $luminaire = null;

    #[ORM\Column(length: 255)]
    private ?string $meuble = null;

    #[ORM\Column(length: 255)]
    private ?string $linge = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getElectromenager(): ?string
    {
        return $this->electromenager;
    }

    public function setElectromenager(string $electromenager): static
    {
        $this->electromenager = $electromenager;

        return $this;
    }

    public function getLuminaire(): ?string
    {
        return $this->luminaire;
    }

    public function setLuminaire(string $luminaire): static
    {
        $this->luminaire = $luminaire;

        return $this;
    }

    public function getMeuble(): ?string
    {
        return $this->meuble;
    }

    public function setMeuble(string $meuble): static
    {
        $this->meuble = $meuble;

        return $this;
    }

    public function getLinge(): ?string
    {
        return $this->linge;
    }

    public function setLinge(string $linge): static
    {
        $this->linge = $linge;

        return $this;
    }
}
