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

    #[ORM\OneToOne(inversedBy: 'review', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project1 $project_id = null;

    #[ORM\OneToOne(inversedBy: 'review', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?client $creator_id = null;

    #[ORM\OneToOne(inversedBy: 'review', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vico $vico_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $overall_rating = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $short_review = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $communication_rating = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $quality_rating = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $value_rating = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectId(): ?Project1
    {
        return $this->project_id;
    }

    public function setProjectId(Project1 $project_id): static
    {
        $this->project_id = $project_id;

        return $this;
    }

    public function getCreatorId(): ?client
    {
        return $this->creator_id;
    }

    public function setCreatorId(client $creator_id): static
    {
        $this->creator_id = $creator_id;

        return $this;
    }

    public function getVicoId(): ?Vico
    {
        return $this->vico_id;
    }

    public function setVicoId(Vico $vico_id): static
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

    public function getOverallRating(): ?int
    {
        return $this->overall_rating;
    }

    public function setOverallRating(int $overall_rating): static
    {
        $this->overall_rating = $overall_rating;

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

    public function getCommunicationRating(): ?int
    {
        return $this->communication_rating;
    }

    public function setCommunicationRating(?int $communication_rating): static
    {
        $this->communication_rating = $communication_rating;

        return $this;
    }

    public function getQualityRating(): ?int
    {
        return $this->quality_rating;
    }

    public function setQualityRating(?int $quality_rating): static
    {
        $this->quality_rating = $quality_rating;

        return $this;
    }

    public function getValueRating(): ?int
    {
        return $this->value_rating;
    }

    public function setValueRating(?int $value_rating): static
    {
        $this->value_rating = $value_rating;

        return $this;
    }
}
