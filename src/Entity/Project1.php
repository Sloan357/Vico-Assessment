<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Project1Repository;

#[ORM\Entity(repositoryClass: Project1Repository::class)]
class Project1
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'project1s')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $creator_id = null;

    #[ORM\ManyToOne(inversedBy: 'project1s')]
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

    public function setCreated(): void
    {
        $this->created = new DateTime('now');
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

    public function setReview(?Review $review): static
    {
        // unset the owning side of the relation if necessary
        if ($review === null && $this->review !== null) {
            $this->review->setProjectId(null);
        }

        // set the owning side of the relation if necessary
        if ($review !== null && $review->getProjectId() !== $this) {
            $review->setProjectId($this);
        }

        $this->review = $review;

        return $this;
    }
}
