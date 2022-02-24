<?php

declare(strict_types=1);

namespace App\Application\Slots\Update\DTO;

class DoctorDTO
{
    private int $doctorId;

    public function __construct(int $doctorId)
    {
        $this->doctorId = $doctorId;
    }

    public function getDoctorId(): int
    {
        return $this->doctorId;
    }
}
