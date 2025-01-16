<?php

namespace App\Entity;

use App\Repository\PlanificationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanificationRepository::class)]
class Planification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $start_datum = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end_date = null;

    /**
     * @var Collection<int, Employee>
     */
    #[ORM\OneToMany(targetEntity: Employee::class, mappedBy: 'planification')]
    private Collection $employe;

    /**
     * @var Collection<int, Departement>
     */
    #[ORM\OneToMany(targetEntity: Departement::class, mappedBy: 'planification')]
    private Collection $dpartment;

    /**
     * @var Collection<int, Status>
     */
    #[ORM\OneToMany(targetEntity: Status::class, mappedBy: 'planification')]
    private Collection $status;

    /**
     * @var Collection<int, Jour>
     */
    #[ORM\OneToMany(targetEntity: Jour::class, mappedBy: 'planification')]
    private Collection $jour;

    public function __construct()
    {
        $this->employe = new ArrayCollection();
        $this->dpartment = new ArrayCollection();
        $this->status = new ArrayCollection();
        $this->jour = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDatum(): ?\DateTimeInterface
    {
        return $this->start_datum;
    }

    public function setStartDatum(?\DateTimeInterface $start_datum): static
    {
        $this->start_datum = $start_datum;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getEmploye(): Collection
    {
        return $this->employe;
    }

    public function addEmploye(Employee $employe): static
    {
        if (!$this->employe->contains($employe)) {
            $this->employe->add($employe);
            $employe->setPlanification($this);
        }

        return $this;
    }

    public function removeEmploye(Employee $employe): static
    {
        if ($this->employe->removeElement($employe)) {
            // set the owning side to null (unless already changed)
            if ($employe->getPlanification() === $this) {
                $employe->setPlanification(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Departement>
     */
    public function getDpartment(): Collection
    {
        return $this->dpartment;
    }

    public function addDpartment(Departement $dpartment): static
    {
        if (!$this->dpartment->contains($dpartment)) {
            $this->dpartment->add($dpartment);
            $dpartment->setPlanification($this);
        }

        return $this;
    }

    public function removeDpartment(Departement $dpartment): static
    {
        if ($this->dpartment->removeElement($dpartment)) {
            // set the owning side to null (unless already changed)
            if ($dpartment->getPlanification() === $this) {
                $dpartment->setPlanification(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Status>
     */
    public function getStatus(): Collection
    {
        return $this->status;
    }

    public function addStatus(Status $status): static
    {
        if (!$this->status->contains($status)) {
            $this->status->add($status);
            $status->setPlanification($this);
        }

        return $this;
    }

    public function removeStatus(Status $status): static
    {
        if ($this->status->removeElement($status)) {
            // set the owning side to null (unless already changed)
            if ($status->getPlanification() === $this) {
                $status->setPlanification(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Jour>
     */
    public function getJour(): Collection
    {
        return $this->jour;
    }

    public function addJour(Jour $jour): static
    {
        if (!$this->jour->contains($jour)) {
            $this->jour->add($jour);
            $jour->setPlanification($this);
        }

        return $this;
    }

    public function removeJour(Jour $jour): static
    {
        if ($this->jour->removeElement($jour)) {
            // set the owning side to null (unless already changed)
            if ($jour->getPlanification() === $this) {
                $jour->setPlanification(null);
            }
        }

        return $this;
    }
}
