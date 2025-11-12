<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nazvanie = null;

    #[ORM\Column(length: 255)]
    private ?string $redcost = null;

    #[ORM\Column(length: 255)]
    private ?string $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazvanie(): ?string
    {
        return $this->Nazvanie;
    }

    public function setNazvanie(string $Nazvanie): static
    {
        $this->Nazvanie = $Nazvanie;

        return $this;
    }

    public function getRedcost(): ?string
    {
        return $this->redcost;
    }

    public function setRedcost(string $redcost): static
    {
        $this->redcost = $redcost;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }
}
