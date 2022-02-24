<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\Slots\Query;

use App\Application\Slots\Persistence\Slot as PersistedSlot;
use App\Application\Slots\Query\Slot;
use App\Application\Slots\Query\SlotsRepository as SlotsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SlotsRepository extends ServiceEntityRepository implements SlotsRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        $entities = parent::findAll();

        return array_map(
            static fn(PersistedSlot $entity) => new Slot($entity->getId(), $entity->getDateFrom(), $entity->getDateTo()),
            $entities
        );
    }
}
