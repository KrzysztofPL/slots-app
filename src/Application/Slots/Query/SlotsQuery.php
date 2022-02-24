<?php

declare(strict_types=1);

namespace App\Application\Slots\Query;

use App\Application\Slots\Query\Sorter\SorterPool;
use App\Application\Slots\Query\Sorter\SorterType;

class SlotsQuery
{
    private SlotsRepository $slotsRepository;
    private SorterPool $sorterPool;

    public function __construct(SlotsRepository $slotsRepository, SorterPool $sorterPool)
    {
        $this->slotsRepository = $slotsRepository;
        $this->sorterPool = $sorterPool;
    }

    public function get(SorterType $sorterType, \DateTimeImmutable $from, \DateTimeImmutable $to): SortedQueryResult
    {
        $slots = $this->slotsRepository->findAll();
        $sorter = $this->sorterPool->getForType($sorterType);
        $sortedSlots = $sorter->getSorted(...$slots);

        return new SortedQueryResult(...$sortedSlots);
    }
}
