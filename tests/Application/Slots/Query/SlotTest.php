<?php

declare(strict_types=1);

namespace App\Tests\Application\Slots\Query;

use App\Application\Slots\Query\Slot;
use PHPUnit\Framework\TestCase;

class SlotTest extends TestCase
{
    public function testItReturnsDurationInSeconds()
    {
        $slot = new Slot(
            1,
            new \DateTimeImmutable('2022-02-24 01:00:00'),
            new \DateTimeImmutable('2022-02-24 02:00:00')
        );

        $this->assertEquals(3600, $slot->durationInSeconds());
    }
}
