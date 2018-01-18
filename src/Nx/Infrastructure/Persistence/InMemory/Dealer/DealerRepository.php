<?php

namespace Nx\Infrastructure\Persistence\InMemory\Dealer;

use Nx\Domain\Model\Dealer\Dealer;
use Nx\Domain\Model\Dealer\DealerNotFoundException;

interface DealerRepository
{
    /**
     * @param Dealer $dealer
     * @return void
     */
    public function store(Dealer $dealer): void;

    /**
     * @param $dealerId
     * @return void
     * @throws DealerNotFoundException
     */
    public function remove($dealerId): void;

    /**
     * @param $dealerId
     * @return Dealer
     * @throws DealerNotFoundException
     */
    public function get($dealerId): Dealer;

    /**
     * @return Dealer[]
     */
    public function getAll(): array;
}