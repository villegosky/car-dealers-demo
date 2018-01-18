<?php

namespace Nx\Domain\Model\Dealer;

use Ramsey\Uuid\UuidInterface;

/**
 * Class VehicleId
 * @package Nx\Domain\Model\Dealer
 */
class VehicleId
{
    private $uuid;

    public function __construct(UuidInterface $vehicleId)
    {
        $this->uuid = $vehicleId;
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