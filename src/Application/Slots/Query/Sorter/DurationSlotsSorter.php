<?php

declare(strict_types=1);

namespace App\Application\Slots\Query\Sorter;

use App\Application\Slots\Query\Slot;

class DurationSlotsSorter implements SlotsSorter
{
    public function supports(SorterType $type): bool
    {
        return SorterType::DURATION()->equals($type);
    }

    /**
     * @inheritDoc
     */
    public function getSorted(Slot ...$slots): array
    {
        // TODO: Implement getSorted() method.
        return $slots;
    }
}
