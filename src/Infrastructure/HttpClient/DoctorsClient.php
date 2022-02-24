<?php

declare(strict_types=1);

namespace App\Infrastructure\HttpClient;

use App\Application\Slots\Update\DTO\DoctorDTO;
use App\Application\Slots\Update\DTO\DoctorsDTOCollection;
use App\Application\Slots\Update\Exception\CouldNotPullDoctorsException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class DoctorsClient implements \App\Application\Slots\Update\Client\DoctorsClient
{
    private const URL = '/api/doctors';
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws CouldNotPullDoctorsException
     */
    public function getDoctors(): DoctorsDTOCollection
    {
        try {
            $response = $this
                ->client
                ->request('GET', self::URL)
                ->toArray();
        } catch (\Throwable $e) {
            throw CouldNotPullDoctorsException::create();
        }

        return $this->mapResponseToDTOCollection($response);
    }

    private function mapResponseToDTOCollection(array $response): DoctorsDTOCollection
    {
        $collection = new DoctorsDTOCollection();

        foreach ($response as $responseItem) {
            $doctor = new DoctorDTO($responseItem['id']);

            $collection->add($doctor);
        }

        return $collection;
    }
}
