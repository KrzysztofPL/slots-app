<?php

namespace App\Infrastructure\Repository\Slots\Update;

use App\Application\Slots\Persistence\Slot;
use App\Application\Slots\Update\Exception\CouldNotPersistSlotsException;
use App\Application\Slots\Update\SlotsRepository as SlotsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method Slot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Slot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Slot[]    findAll()
 * @method Slot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SlotsRepository extends ServiceEntityRepository implements SlotsRepositoryInterface
{
    private LoggerInterface $logger;

    public function __construct(ManagerRegistry $registry, LoggerInterface $logger)
    {
        parent::__construct($registry, Slot::class);
        $this->logger = $logger;
    }

    /**
     * @throws CouldNotPersistSlotsException
     */
    public function saveMany(Slot ...$slots)
    {
        $entityManager = $this->getEntityManager();

        foreach ($slots as $slot) {
            try {
                $entityManager->persist($slot);
            } catch (ORMException $e) {
                $this->logger->error($e);
            }
        }

        try {
            $entityManager->flush();
        } catch (OptimisticLockException | ORMException $e) {
            $this->logger->error($e);

            throw CouldNotPersistSlotsException::create();
        }
    }
}
