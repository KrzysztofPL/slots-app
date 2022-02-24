<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\Slots\Query\SortedQueryResult;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ListSlotsResponse extends JsonResponse
{
    public static function fromQueryResult(SortedQueryResult $queryResult): self
    {
        // TODO map result to response
        return new self();
    }
}
