<?php

declare(strict_types=1);

namespace App\Application\Slots\Update\DTO;

class DoctorsDTOCollection
{
    private array $doctors;

    public function add(DoctorDTO $doctorDTO): void
    {
        $this->doctors[] = $doctorDTO;
    }

    /**
     * @return DoctorDTO[]
     */
    public function toArray(): array
    {
        return $this->doctors;
    }
}
