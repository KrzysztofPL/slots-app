<?php

declare(strict_types=1);

namespace App\Tests\Application\Slots\Query\Sorter;

use App\Application\Slots\Query\Slot;
use App\Application\Slots\Query\Sorter\DurationSlotsSorter;
use PHPUnit\Framework\TestCase;

class DurationSlotsSorterTest extends TestCase
{
    public function testSlotsAreSortedByDuration()
    {
        $sorter = new DurationSlotsSorter();

        $oneHourLongSlot = new Slot(
            1,
            new \DateTimeImmutable('2022-02-24 01:00:00'),
            new \DateTimeImmutable('2022-02-24 02:00:00')
        );

        $oneMinuteLongSlot = new Slot(
            2,
            new \DateTimeImmutable('2022-02-24 01:00:00'),
            new \DateTimeImmutable('2022-02-24 02:00:00')
        );

        $oneDayLongSlot = new Slot(
            3,
            new \DateTimeImmutable('2022-02-24 01:00:00'),
            new \DateTimeImmutable('2022-02-25 01:00:00')
        );

        $unsortedSlots = [$oneHourLongSlot, $oneMinuteLongSlot, $oneDayLongSlot];
        $expectedOrder = [$oneDayLongSlot, $oneHourLongSlot, $oneMinuteLongSlot];

        $sortedSlots = $sorter->getSorted(...$unsortedSlots);
        $this->assertEquals($sortedSlots, $expectedOrder);
    }
}
