<?php

declare(strict_types=1);

namespace App\Application\Slots\Update\UseCase;

use App\Application\Slots\Update\Client\DoctorsClient;
use App\Application\Slots\Update\Exception\CouldNotPullSlotsException;
use Psr\Log\LoggerInterface;

class UpdateAllDoctorSlots
{
    private DoctorsClient $doctorsClient;
    private UpdateDoctorSlots $updateDoctorSlots;
    private LoggerInterface $logger;

    public function __construct(DoctorsClient $doctorsClient, UpdateDoctorSlots $updateDoctorSlots, LoggerInterface $logger)
    {
        $this->doctorsClient = $doctorsClient;
        $this->updateDoctorSlots = $updateDoctorSlots;
        $this->logger = $logger;
    }

    public function execute(): void
    {
        $doctors = $this->doctorsClient->getDoctors();

        foreach ($doctors->toArray() as $doctorDTO) {
            try {
                $this->updateDoctorSlots->execute($doctorDTO);
            } catch (CouldNotPullSlotsException $e) {
                $this->logger->error($e);
            }
        }
    }
}
