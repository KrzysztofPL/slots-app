<?php

declare(strict_types=1);

namespace App\Application\Slots\Query\Sorter;

use App\Application\Slots\Query\Exception\InvalidSorterException;

class SorterPool
{
    private array $sorters;

    public function __construct(SlotsSorter ...$sorters)
    {
        $this->sorters = $sorters;
    }

    /**
     * @throws InvalidSorterException
     */
    public function getForType(SorterType $type): SlotsSorter
    {
        foreach ($this->sorters as $sorter) {
            if ($sorter->supports($type)) {
                return $sorter;
            }
        }

        throw InvalidSorterException::createForSorter($type->getValue());
    }
}
