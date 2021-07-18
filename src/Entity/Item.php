<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
#[ApiResource]
class Item
{
    public const HEAD_TYPE = 0;
    public const BODY_TYPE = 1;
    public const HANDS_TYPE = 2;
    public const WEAPON_TYPE = 3;
    public const SHIELD_TYPE = 4;
    public const LEGS_TYPE = 5;
    public const FEET_TYPE = 6;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $title;

    /**
     * @ORM\Column(type="integer")
     */
    private int $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $image;

    /**
     * @ORM\OneToOne(targetEntity=Store::class, mappedBy="item", cascade={"persist", "remove"})
     */
    private ?Store $store;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getStore(): ?Store
    {
        return $this->store;
    }

    public function setStore(Store $store): self
    {
        // set the owning side of the relation if necessary
        if ($store->getItem() !== $this) {
            $store->setItem($this);
        }

        $this->store = $store;

        return $this;
    }
}
