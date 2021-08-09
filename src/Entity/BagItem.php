<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BagItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BagItemRepository::class)
 */
#[ApiResource]
class BagItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Bag::class, inversedBy="bagItems", cascade={"persist"})
     */
    private ?Bag $bag;

    /**
     * @ORM\ManyToOne(targetEntity=Item::class, inversedBy="bagItems", cascade={"persist"})
     */
    private ?Item $item;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBag(): Bag
    {
        return $this->bag;
    }

    public function setBag(?Bag $bag): self
    {
        $this->bag = $bag;

        return $this;
    }

    public function getItem(): Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
