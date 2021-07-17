<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class AbstractRepository
 * @package App\Repository
 */
abstract class AbstractRepository extends ServiceEntityRepository
{
    public function save($entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }
}