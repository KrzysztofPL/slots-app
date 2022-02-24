<?php

declare(strict_types=1);

namespace App\Application\Slots\Query;

interface SlotsRepository
{
    /**
     * @return Slot[]
     */
    public function findAll(): array;
}
