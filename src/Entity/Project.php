<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $creator_id = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    private ?Vico $vico_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToOne(mappedBy: 'project_id', cascade: ['persist', 'remove'])]
    private ?Review $review = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatorId(): ?Client
    {
        return $this->creator_id;
    }

    public function setCreatorId(?Client $creator_id): static
    {
        $this->creator_id = $creator_id;

        return $this;
    }

    public function getVicoId(): ?Vico
    {
        return $this->vico_id;
    }

    public function setVicoId(?Vico $vico_id): static
    {
        $this->vico_id = $vico_id;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): static
    {
        $this->created = $created;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getReview(): ?Review
    {
        return $this->review;
    }

    public function setReview(Review $review): static
    {
        // set the owning side of the relation if necessary
        if ($review->getProjectId() !== $this) {
            $review->setProjectId($this);
        }

        $this->review = $review;

        return $this;
    }
}
