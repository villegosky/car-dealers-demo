<?php

namespace Nx\Infrastructure\Persistence\Doctrine\Dealer;

use Doctrine\ORM\EntityManager;
use Nx\Domain\Model\Dealer\Dealer;
use Nx\Domain\Model\Dealer\DealerNotFoundException;
use Nx\Infrastructure\Persistence\InMemory\Dealer\DealerRepository;

/**
 * Class DoctrineDealerRepository
 * @package Nx\Infrastructure\Persistence\Doctrine\Dealer
 */
class DoctrineDealerRepository implements DealerRepository
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * DoctrineDealerRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Dealer $dealer
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(Dealer $dealer): void
    {
        $this->entityManager->persist($dealer);
        $this->entityManager->flush();
    }

    /**
     * @param $dealerId
     * @throws DealerNotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function remove($dealerId): void
    {
        $dealer = $this->entityManager->find(Dealer::class, $dealerId);
        if (!$dealer) {
            throw DealerNotFoundException::forId($dealerId);
        }

        $this->entityManager->remove($dealer);
        $this->entityManager->flush();
    }

    /**
     * @param $dealerId
     * @return Dealer
     * @throws DealerNotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function get($dealerId): Dealer
    {
        $dealer = $this->entityManager->find(Dealer::class, $dealerId);
        if (!$dealer) {
            throw DealerNotFoundException::forId($dealerId);
        }

        return $dealer;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->entityManager->getRepository(Dealer::class)->findAll();
    }

}