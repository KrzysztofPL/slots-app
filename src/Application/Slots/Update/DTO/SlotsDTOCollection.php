<?php

declare(strict_types=1);

namespace App\Application\Slots\Update\DTO;

class SlotsDTOCollection
{
    /** @var SlotDTO[] */
    private array $slots;

    public function __construct(int $doctorId)
    {
    }

    public function add(SlotDTO $slot): void
    {
        $this->slots[] = $slot;
    }

    public function toArray(): array
    {
        return $this->slots;
    }
}
