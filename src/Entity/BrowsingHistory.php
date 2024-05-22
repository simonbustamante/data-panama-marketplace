<?php

namespace App\Entity;

use App\Repository\BrowsingHistoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrowsingHistoryRepository::class)]
class BrowsingHistory
{
    #[ORM\GeneratedValue]
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $historyId = null;

    #[ORM\ManyToOne]
    private ?Product $productId = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $visitedDate = null;

    #[ORM\ManyToOne]
    private ?User $userId = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getHistoryId(): ?int
    {
        return $this->historyId;
    }

    public function setHistoryId(int $historyId): static
    {
        $this->historyId = $historyId;

        return $this;
    }

    public function getProductId(): ?Product
    {
        return $this->productId;
    }

    public function setProductId(?Product $productId): static
    {
        $this->productId = $productId;

        return $this;
    }

    public function getVisitedDate(): ?\DateTimeInterface
    {
        return $this->visitedDate;
    }

    public function setVisitedDate(\DateTimeInterface $visitedDate): static
    {
        $this->visitedDate = $visitedDate;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): static
    {
        $this->userId = $userId;

        return $this;
    }
}
