<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Item;
use App\Entity\Store;
use Doctrine\ORM\EntityManagerInterface;

class StoreService
{
    private EntityManagerInterface $em;

    public function __construct(
        EntityManagerInterface $em
    ) {
        $this->em = $em;
    }

     ///////////////////////
    /// JUST AN EXAMPLE ///
   ///////////////////////
    public function checkItem(
      int $id
    ): ?Item {
        $item = $this->em->getRepository(Store::class)->find($id);

        if ($item instanceof Store) {
            if ($item->getQuantity() > 0) {
                return $item->getItem();
            } else {
                echo 'The item is over!';
            }

            if ($item->getPrice() >= 100) {
                echo 'Very expensive item!';
                return $item->getItem();
            }
        }
        return null;
    }

    public function add(
        Item $item,
        int $quantity,
        int $price
    ): void {
        $repository = $this->em->getRepository(Store::class);
        $store = new Store();

        $store->setItem($item)
            ->setQuantity($quantity)
            ->setPrice($price);

        $isExist = $repository->findOneBy([
            'item' => $store->getItem()
        ]);

        if (!$isExist) {
            $this->em->persist($store);
            $this->em->flush();
        }
    }

    public function show(): array
    {
        return $this->em->getRepository(Store::class)->findAll();
    }

    public function edit(
        int $id
    ): void {
        $ship = $this->em->getRepository(Store::class)->find($id);

        if ($ship instanceof Store) {
            $ship->setPrice(rand(10, 50));

            $this->em->flush();
        }
    }

    public function delete(
        int $id
    ): void {
        $repository = $this->em->getRepository(Store::class)->find($id);

        $this->em->remove($repository);
        $this->em->flush();
    }
}