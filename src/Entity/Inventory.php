<?php

namespace App\Entity;

use App\Repository\InventoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InventoryRepository::class)]
class Inventory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]


    

    #[ORM\ManyToOne(targetEntity: Subject::class, inversedBy: "inventories")]
    #[ORM\JoinColumn(nullable: false)]
   
    private ?int $id = null;
    #[ORM\ManyToOne(targetEntity: Player::class, inversedBy: "inventories")]
    #[ORM\JoinColumn(nullable: false)]
    #[ORM\Column(length: 255)]


    private ?string $name = null;
    #[ORM\ManyToOne(targetEntity: Inventory::class, inversedBy: "inventories")]
    #[ORM\JoinColumn(nullable: false)]
    

    #[ORM\Column(length: 255)]
    private ?string $nazvanie = null;

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

    public function getNazvanie(): ?string
    {
        return $this->nazvanie;
    }

    public function setNazvanie(string $nazvanie): static
    {
        $this->nazvanie = $nazvanie;

        return $this;
    }
}
