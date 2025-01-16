<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartementRepository::class)]
class Departement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $ref = null;

    #[ORM\ManyToOne(inversedBy: 'dpt')]
    private ?Employee $employee = null;

    #[ORM\ManyToOne(inversedBy: 'dpartment')]
    private ?Planification $planification = null;

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

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): static
    {
        $this->ref = $ref;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): static
    {
        $this->employee = $employee;

        return $this;
    }

    public function getPlanification(): ?Planification
    {
        return $this->planification;
    }

    public function setPlanification(?Planification $planification): static
    {
        $this->planification = $planification;

        return $this;
    }
}
