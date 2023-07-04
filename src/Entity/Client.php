<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $username = null;

    #[ORM\Column(length: 96)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(length: 96)]
    private ?string $first_name = null;

    #[ORM\Column(length: 96)]
    private ?string $last_name = null;

    #[ORM\OneToMany(mappedBy: 'creator_id', targetEntity: Project1::class)]
    private Collection $project1s;

    public function __construct()
    {
        $this->project1s = new ArrayCollection();
    }

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(): void
    {
        $this->created = new DateTime('now');
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * @return Collection<int, Project1>
     */
    public function getProject1s(): Collection
    {
        return $this->project1s;
    }

    public function addProject1(Project1 $project1): static
    {
        if (!$this->project1s->contains($project1)) {
            $this->project1s->add($project1);
            $project1->setCreatorId($this);
        }

        return $this;
    }

    public function removeProject1(Project1 $project1): static
    {
        if ($this->project1s->removeElement($project1)) {
            // set the owning side to null (unless already changed)
            if ($project1->getCreatorId() === $this) {
                $project1->setCreatorId(null);
            }
        }

        return $this;
    }
}
