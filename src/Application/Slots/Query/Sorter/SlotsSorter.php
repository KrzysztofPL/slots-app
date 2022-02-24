<?php

declare(strict_types=1);

namespace App\Application\Slots\Query\Sorter;

use App\Application\Slots\Query\Slot;

interface SlotsSorter
{
    public function supports(SorterType $type): bool;

    /**
     * @return Slot[]
     */
    public function getSorted(Slot ...$slots): array;
}
