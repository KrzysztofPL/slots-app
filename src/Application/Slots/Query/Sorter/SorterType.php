<?php

declare(strict_types=1);

namespace App\Application\Slots\Query\Sorter;

use MyCLabs\Enum\Enum;

/**
 * @method static SorterType DURATION()
 * @method static SorterType DATE_AND_TIME()
 */
final class SorterType extends Enum
{
    private const DURATION = 'duration';
    private const DATE_AND_TIME = 'date_and_time';
}
