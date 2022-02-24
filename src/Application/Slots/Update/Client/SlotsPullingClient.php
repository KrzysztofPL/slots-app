<?php

declare(strict_types=1);

namespace App\Application\Slots\Update\Client;

use App\Application\Slots\Update\DTO\SlotsDTOCollection;
use App\Application\Slots\Update\Exception\CouldNotPullSlotsException;

interface SlotsPullingClient
{
    /**
     * @throws \App\Application\Slots\Update\Exception\CouldNotPullSlotsException
     */
    public function getDoctorSlots(int $doctorId): SlotsDTOCollection;
}
