<?php

declare(strict_types=1);

namespace App\Application\Slots\Update\Exception;

class CouldNotPullSlotsException extends \Exception
{
    public static function createForDoctor(int $doctorId): self
    {
        return new self(sprintf('Pulling slots failed for doctor ID %d', $doctorId));
    }
}
