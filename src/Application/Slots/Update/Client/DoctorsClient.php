<?php

declare(strict_types=1);

namespace App\Application\Slots\Update\Client;

use App\Application\Slots\Update\DTO\DoctorsDTOCollection;

interface DoctorsClient
{
    public function getDoctors(): DoctorsDTOCollection;
}
