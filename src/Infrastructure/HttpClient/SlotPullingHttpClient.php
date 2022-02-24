<?php

declare(strict_types=1);

namespace App\Infrastructure\HttpClient;

use App\Application\Slots\Update\Client\SlotsPullingClient;
use App\Application\Slots\Update\DTO\SlotDTO;
use App\Application\Slots\Update\DTO\SlotsDTOCollection;
use App\Application\Slots\Update\Exception\CouldNotPullSlotsException;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class SlotPullingHttpClient implements SlotsPullingClient
{
    private const URL = '/api/doctors/%d/slots';

    private HttpClientInterface $client;
    private LoggerInterface $logger;

    public function __construct(HttpClientInterface $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    public function getDoctorSlots(int $doctorId): SlotsDTOCollection
    {
        try {
            $response = $this->client->request('GET', $this->buildUrl($doctorId))->toArray();
        } catch (\Throwable $e) {
            $this->logger->error($e);
            throw CouldNotPullSlotsException::createForDoctor($doctorId);
        }

        return $this->mapResponseToDTOCollection($doctorId, $response);
    }

    private function buildUrl(int $doctorId): string
    {
        return sprintf(
            self::URL, $doctorId
        );
    }

    private function mapResponseToDTOCollection(int $doctorId, array $response): SlotsDTOCollection
    {
        $slotsCollection = new SlotsDTOCollection($doctorId);

        foreach ($response as $responseItem) {

            try {
                $slotDTO = new SlotDTO(
                    new \DateTimeImmutable($responseItem['start']),
                    new \DateTimeImmutable($responseItem['end'])
                );

                $slotsCollection->add($slotDTO);
            } catch (\Exception $e) {
                $this->logger->error($e);
            }
        }

        return $slotsCollection;
    }
}
