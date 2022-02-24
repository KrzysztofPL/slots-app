<?php

declare(strict_types=1);

namespace App\Application\Slots\Query\Exception;

class InvalidSorterException extends \Exception
{
    public static function createForSorter(string $sorter): self
    {
        return new self(
            sprintf('There is no sorter like: %s', $sorter)
        );
    }
}
