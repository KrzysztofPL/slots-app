<?php

declare(strict_types=1);

namespace App\Application\Slots\Update;

use App\Application\Slots\Persistence\Slot;
use App\Application\Slots\Update\Exception\CouldNotPersistSlotsException;

interface SlotsRepository
{
    /**
     * @throws \App\Application\Slots\Update\Exception\CouldNotPersistSlotsException
     */
    public function saveMany(Slot ...$slots);
}
