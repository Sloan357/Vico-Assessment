<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VicoRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: VicoRepository::class)]
class Vico
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\OneToMany(mappedBy: 'vico_id', targetEntity: Project1::class)]
    private Collection $project1s;

    #[ORM\OneToOne(mappedBy: 'vico_id', cascade: ['persist', 'remove'])]
    private ?Review $review = null;

    public function __construct()
    {
        $this->project1s = new ArrayCollection();
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

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(): void
    {
        $this->created = new DateTime('now');
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
            $project1->setVicoId($this);
        }

        return $this;
    }

    public function removeProject1(Project1 $project1): static
    {
        if ($this->project1s->removeElement($project1)) {
            // set the owning side to null (unless already changed)
            if ($project1->getVicoId() === $this) {
                $project1->setVicoId(null);
            }
        }

        return $this;
    }

    public function getReview(): ?Review
    {
        return $this->review;
    }

    public function setReview(?Review $review): static
    {
        // unset the owning side of the relation if necessary
        if ($review === null && $this->review !== null) {
            $this->review->setVicoId(null);
        }

        // set the owning side of the relation if necessary
        if ($review !== null && $review->getVicoId() !== $this) {
            $review->setVicoId($this);
        }

        $this->review = $review;

        return $this;
    }
}
