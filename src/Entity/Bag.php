<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BagRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BagRepository::class)
 */
#[ApiResource]
class Bag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Hero::class, inversedBy="bag", cascade={"persist", "remove"})
     */
    private $hero;

    /**
     * @ORM\OneToMany(targetEntity=BagItem::class, mappedBy="bag", cascade={"persist", "remove"})
     */
    private Collection $bagItems;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHero(): ?Hero
    {
        return $this->hero;
    }

    public function setHero(?Hero $hero): self
    {
        $this->hero = $hero;

        return $this;
    }

    public function getBagItems(): Collection
    {
        return $this->bagItems;
    }

    public function addBagItem(BagItem $bagItem): self
    {
        if (!$this->bagItems->contains($bagItem)) {
            $this->bagItems[] = $bagItem;
            $bagItem->setBag($this);
        }

        return $this;
    }

    public function removeBagItem(BagItem $bagItem): self
    {
        if ($this->bagItems->removeElement($bagItem)) {
            if ($bagItem->getBag() === $this) {
                $bagItem->setBag(null);
            }
        }

        return $this;
    }
}
