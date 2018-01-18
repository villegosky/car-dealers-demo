<?php

namespace Nx\Infrastructure\Persistence\InMemory\Dealer;

use Nx\Domain\Model\Dealer\Dealer;
use Nx\Domain\Model\Dealer\DealerNotFoundException;

/**
 * Class InMemoryDealerRepository
 * @package Nx\Infrastructure\Persistence\InMemory\Dealer
 */
class InMemoryDealerRepository implements DealerRepository
{
    /**
     * @var array
     */
    private $dealers = [];

    /**
     * @param Dealer $dealer
     */
    public function store(Dealer $dealer) : void
    {
        $this->dealers[(string)$dealer->dealerId()] = $dealer;
    }

    /**
     * @param $dealerId
     * @throws DealerNotFoundException
     */
    public function remove($dealerId) : void
    {
        $dealer = $this->get($dealerId);

        unset($this->dealers[(string)$dealer->dealerId()]);
    }

    /**
     * @param $dealerId
     * @return Dealer
     * @throws DealerNotFoundException
     */
    public function get($dealerId) : Dealer
    {
        if (!isset($this->dealers[$dealerId])) {
            throw new DealerNotFoundException(sprintf('Dealer ID(%s) not found', $dealerId));
        }

        return $this->dealers[$dealerId];
    }

    /**
     * @return Dealer[]
     */
    public function getAll() : array
    {
        return $this->dealers;
    }
}