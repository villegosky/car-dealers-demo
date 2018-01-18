<?php

namespace Nx\Application\Service\Dealer;

use Nx\Domain\Model\Dealer\Dealer;
use Nx\Infrastructure\Persistence\InMemory\Dealer\DealerRepository;
use Ramsey\Uuid\Uuid;

/**
 * Class DealerService
 * @package Nx\Application\Service\Dealer
 */
class DealerService
{
    /**
     * @var DealerRepository
     */
    private $dealerRepository;

    /**
     * DealerService constructor.
     * @param DealerRepository $dealerRepository
     */
    public function __construct(DealerRepository $dealerRepository)
    {
        $this->dealerRepository = $dealerRepository;
    }

    /**
     * @param array $data
     * @return array
     */
    public function addDealer(array $data)
    {
        $newDealer = Dealer::fromArray($data);

        $this->dealerRepository->store($newDealer);

        return $newDealer->toArray();
    }

    /**
     * @param $dealerId
     * @param array $data
     * @return array
     * @throws \Nx\Domain\Model\Dealer\DealerNotFoundException
     */
    public function updateDealer($dealerId, array $data)
    {
        $dealer = $this->dealerRepository->get($dealerId);

        $dealer->update($data);

        $this->dealerRepository->store($dealer);

        return $dealer->toArray();
    }

    /**
     * @param $dealerId
     * @throws \Nx\Domain\Model\Dealer\DealerNotFoundException
     */
    public function removeDealer($dealerId)
    {
        $this->dealerRepository->remove($dealerId);
    }

    /**
     * @param $dealerId
     * @return array
     * @throws \Nx\Domain\Model\Dealer\DealerNotFoundException
     */
    public function loadDealer($dealerId)
    {
        $dealer = $this->dealerRepository->get($dealerId);

        return $dealer->toArray();
    }

    /**
     * @return array
     */
    public function listAllDealers()
    {
        $dealers = $this->dealerRepository->getAll();

        $dealerArrays = [];
        foreach ($dealers as $dealer) {
            $dealerArrays[] = $dealer->toArray();
        }

        return $dealerArrays;
    }
}