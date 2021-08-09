<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Hero;
use App\Entity\Item;
use App\Entity\BagItem;
use Doctrine\ORM\EntityManagerInterface;

class BagService
{
    private EntityManagerInterface $em;

    public function __construct(
        EntityManagerInterface $em
    ) {
        $this->em = $em;
    }

    public function getBagItems(): array
    {
        $currentUser = $this->em->find(Hero::class, 41);
        $items = $currentUser->getBag()->getBagItems();
        $bagItems = [];

        foreach ($items as $item) {
            $bagItems[] = $item;
        }

        return $bagItems;
//        TODO replace $currentUser, get an authorized user
    }

    public function getItems(int $id): ?Item
    {
        return $this->em->getRepository(Item::class)->find($id);
    }

    public function addItem(
        int $itemId,
        int $quantity
    ): void {
        $currentUser = $this->em->find(Hero::class, 41);
        $bag = new BagItem();
        $bagItemId = [];

        $bag
            ->setBag($currentUser->getBag())
            ->setItem($this->getItems($itemId))
            ->setQuantity($quantity);

        foreach ($this->getBagItems() as $bagItem) {
            $bagItemId[] = $bagItem->getItem()->getId();

            if ($bagItem->getItem() === $bag->getItem()) {
                $bagItem->setQuantity($bagItem->getQuantity() + $bag->getQuantity());
                $this->em->persist($bagItem);
            }
        }

        if ((array_search($bag->getItem()->getId(), $bagItemId, true)) === false) {
            $this->em->persist($bag);
        }

        $this->em->flush();
//        TODO replace $currentUser, get an authorized user
    }

    public function deleteAllItems(): void
    {
        $currentUser = $this->em->find(Hero::class, 42);

        foreach ($currentUser->getBag()->getBagItems() as $bagItem) {
            $this->em->remove($bagItem);
        }

        $this->em->flush();
//        TODO replace $currentUser, get an authorized user
    }

    public function deleteItem(int $id): void
    {
        $currentUser = $this->em->find(Hero::class, 41);

        foreach ($currentUser->getBag()->getBagItems() as $bagItem) {
            if ($bagItem->getId() === $id) {
                $this->em->remove($bagItem);
            }
        }

        $this->em->flush();
//        TODO replace $currentUser, get an authorized user
    }
}