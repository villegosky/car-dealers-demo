<?php

namespace Nx\Domain\Model\Dealer;

use Ramsey\Uuid\UuidInterface;

/**
 * Class ListingId
 * @package Nx\Domain\Model\Dealer
 */
class ListingId
{
    private $uuid;

    public function __construct(UuidInterface $listingId)
    {
        $this->uuid = $listingId;
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