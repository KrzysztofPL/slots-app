<?php

declare(strict_types=1);

namespace App\Application\Slots\Update\Exception;

class CouldNotPersistSlotsException extends \Exception
{
    public static function create(): self
    {
        return new self('Persisting slots failed');
    }
}
