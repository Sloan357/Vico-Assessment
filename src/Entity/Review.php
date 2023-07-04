<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReviewRepository;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $overall_rating = null;

    #[ORM\OneToOne(mappedBy: 'review', cascade: ['persist', 'remove'])]
    private ?OptionalReview $optionalReview = null;

    #[ORM\OneToOne(inversedBy: 'review', cascade: ['persist', 'remove'])]
    private ?Project1 $project_id = null;

    #[ORM\OneToOne(inversedBy: 'review', cascade: ['persist', 'remove'])]
    private ?Client $creator_id = null;

    #[ORM\OneToOne(inversedBy: 'review', cascade: ['persist', 'remove'])]
    private ?Vico $vico_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $short_review = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(): void
    {
        $this->created = new DateTime('now');
    }

    public function getOverallRating(): ?int
    {
        return $this->overall_rating;
    }

    public function setOverallRating(int $overall_rating): static
    {
        $this->overall_rating = $overall_rating;

        return $this;
    }

    public function getOptionalReview(): ?OptionalReview
    {
        return $this->optionalReview;
    }

    public function setOptionalReview(?OptionalReview $optionalReview): static
    {
        // unset the owning side of the relation if necessary
        if ($optionalReview === null && $this->optionalReview !== null) {
            $this->optionalReview->setReview(null);
        }

        // set the owning side of the relation if necessary
        if ($optionalReview !== null && $optionalReview->getReview() !== $this) {
            $optionalReview->setReview($this);
        }

        $this->optionalReview = $optionalReview;

        return $this;
    }

    public function getProjectId(): ?Project1
    {
        return $this->project_id;
    }

    public function setProjectId(?Project1 $project_id): static
    {
        $this->project_id = $project_id;

        return $this;
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

    public function getShortReview(): ?string
    {
        return $this->short_review;
    }

    public function setShortReview(string $short_review): static
    {
        $this->short_review = $short_review;

        return $this;
    }
}
