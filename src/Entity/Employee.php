<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    /**
     * @var Collection<int, Departement>
     */
    #[ORM\OneToMany(targetEntity: Departement::class, mappedBy: 'employee')]
    private Collection $dpt;

    #[ORM\ManyToOne(inversedBy: 'employe')]
    private ?Planification $planification = null;

    public function __construct()
    {
        $this->dpt = new ArrayCollection();
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, Departement>
     */
    public function getDpt(): Collection
    {
        return $this->dpt;
    }

    public function addDpt(Departement $dpt): static
    {
        if (!$this->dpt->contains($dpt)) {
            $this->dpt->add($dpt);
            $dpt->setEmployee($this);
        }

        return $this;
    }

    public function removeDpt(Departement $dpt): static
    {
        if ($this->dpt->removeElement($dpt)) {
            // set the owning side to null (unless already changed)
            if ($dpt->getEmployee() === $this) {
                $dpt->setEmployee(null);
            }
        }

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
