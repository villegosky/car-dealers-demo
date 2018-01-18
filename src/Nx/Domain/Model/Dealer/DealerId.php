<?php

namespace Nx\Domain\Model\Dealer;

use Ramsey\Uuid\UuidInterface;


class DealerId
{
    private $uuid;

    public function __construct(UuidInterface $dealerId)
    {
        $this->uuid = $dealerId;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function toString()
    {
        return $this->uuid->toString();
    }
}