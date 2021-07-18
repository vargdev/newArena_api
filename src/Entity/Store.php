<?php

namespace App\Entity;

use DateTimeZone;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\StoreRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass=StoreRepository::class)
 */
#[ApiResource]
class Store
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $quantity;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTimeInterface $boughtAt;

    /**
     * @ORM\OneToOne(targetEntity=Item::class, inversedBy="store", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Item $item;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getBoughtAt(): ?DateTimeInterface
    {
        return $this->boughtAt;
    }

    /**
     * @ORM\PrePersist()
     * @throws \Exception
     */
    public function setBoughtAt(): self
    {
        $this->boughtAt = new DateTime('now', new DateTimeZone('Europe/Kiev'));

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(Item $item): self
    {
        $this->item = $item;

        return $this;
    }
}
