<?php

namespace App\Entity;

use App\Repository\OptionalReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionalReviewRepository::class)]
class OptionalReview
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $communication_rating = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $quality_rating = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $value_rating = null;

    #[ORM\OneToOne(inversedBy: 'optionalReview', cascade: ['persist', 'remove'])]
    private ?Review $review = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getReview(): ?Review
    {
        return $this->review;
    }

    public function setReview(?Review $review): static
    {
        $this->review = $review;

        return $this;
    }
}
