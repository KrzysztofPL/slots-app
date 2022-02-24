<?php

declare(strict_types=1);

namespace App\Application\Slots\Update\Exception;

class CouldNotPullDoctorsException extends \Exception
{
    public static function create(): self
    {
        return new self('Could not pull doctors list');
    }
}
