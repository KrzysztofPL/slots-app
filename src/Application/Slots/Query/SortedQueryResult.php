<?php

declare(strict_types=1);

namespace App\Application\Slots\Query;

class SortedQueryResult
{
    private Slot $slots;

    public function __construct(Slot ...$slots)
    {
        $this->slots = $slots;
    }
}
