<?php
declare(strict_types=1);

namespace App\UI\Controller;

use App\Application\Slots\Query\SlotsQuery;
use App\Application\Slots\Query\Sorter\SorterType;
use App\Infrastructure\Http\ListSlotsRequest;
use App\Infrastructure\Http\ListSlotsResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SlotsController extends AbstractController
{
    /**
     * @Route("/slots", name="slots")
     */
    public function list(ListSlotsRequest $request, SlotsQuery $slotsQuery): Response
    {
        if (!SorterType::isValid($request->getSortType())) {
            // TODO throw sth
        };
        $sorterType = SorterType::from($request->getSortType());
        $result = $slotsQuery->get($sorterType, $request->getDateFrom(), $request->getDateTo());

        // TODO add cache headers
        return ListSlotsResponse::fromQueryResult($result);
    }
}
