<?php

declare(strict_types=1);

namespace App\Application\Slots\Query;

class Slot
{
    private int $id;
    private \DateTimeImmutable $from;
    private \DateTimeImmutable $to;

    public function __construct(int $id, \DateTimeImmutable $from, \DateTimeImmutable $to)
    {
        $this->id = $id;
        $this->from = $from;
        $this->to = $to;
    }

    public function durationInSeconds(): int
    {
        return 1;
    }
}
