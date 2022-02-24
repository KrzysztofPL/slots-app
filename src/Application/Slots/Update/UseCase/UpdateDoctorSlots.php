<?php

declare(strict_types=1);

namespace App\Application\Slots\Update\UseCase;

use App\Application\Slots\Persistence\Slot;
use App\Application\Slots\Update\Client\SlotsPullingClient;
use App\Application\Slots\Update\DTO\DoctorDTO;
use App\Application\Slots\Update\DTO\SlotDTO;
use App\Application\Slots\Update\DTO\SlotsDTOCollection;
use App\Application\Slots\Update\Exception\CouldNotPullSlotsException;
use App\Application\Slots\Update\SlotsRepository;

final class UpdateDoctorSlots
{
    private SlotsPullingClient $client;
    private SlotsRepository $repository;

    public function __construct(SlotsPullingClient $client, SlotsRepository $repository)
    {
        $this->client = $client;
        $this->repository = $repository;
    }

    /**
     * @throws CouldNotPullSlotsException
     */
    public function execute(DoctorDTO $doctorDTO): void
    {
        $slotsDTOCollection = $this->client->getDoctorSlots($doctorDTO->getDoctorId());
        $slots = $this->buildSlots($slotsDTOCollection, $doctorDTO->getDoctorId());
        $this->repository->saveMany(...$slots);
    }

    /**
     * @return \App\Application\Slots\Persistence\Slot[]
     */
    private function buildSlots(SlotsDTOCollection $slots, int $doctorId): array
    {
        return array_map(
            static fn(SlotDTO $slotDTO) => new Slot($doctorId, $slotDTO->getStart(), $slotDTO->getEnd()),
            $slots->toArray()
        );
    }
}
